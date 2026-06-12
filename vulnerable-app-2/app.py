from datetime import datetime
from pprint import pformat
from uuid import uuid4
import pickle

from flask import Flask, request, render_template


app = Flask(__name__)
app.config["MAX_CONTENT_LENGTH"] = 2 * 1024 * 1024


def object_size(value):
    try:
        return str(len(value))
    except TypeError:
        return "n/a"


def object_preview(value):
    return pformat(value, width=100, compact=True)[:6000]


@app.route("/")
def index():
    return render_template("index.html", today=datetime.utcnow().strftime("%b %d"))


@app.route("/upload", methods=["POST"])
def upload():
    uploaded_file = request.files.get("data_file")
    if not uploaded_file:
        return render_template(
            "error.html",
            error="No bundle was attached to the request.",
        ), 400

    try:
        file_data = uploaded_file.read()

        # Vulnerable by design for the lab: untrusted pickle data is executed here.
        data_object = pickle.loads(file_data)

        return render_template(
            "result.html",
            review_id=f"IF-{uuid4().hex[:8].upper()}",
            filename=uploaded_file.filename or "unnamed-bundle.pkl",
            processed_at=datetime.utcnow().strftime("%Y-%m-%d %H:%M UTC"),
            object_type=type(data_object).__name__,
            object_size=object_size(data_object),
            byte_count=f"{len(file_data):,}",
            preview=object_preview(data_object),
        )
    except Exception as exc:
        return render_template("error.html", error=str(exc)), 400


if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000)
