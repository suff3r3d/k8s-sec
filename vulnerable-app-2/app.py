# app.py
from flask import Flask, request, render_template_string
import pickle
import os

app = Flask(__name__)

@app.route('/')
def index():
    return '''
    <h2>Data Serialization Portal v2</h2>
    <p>Upload your data file (.pkl) to parse and process:</p>
    <form action="/upload" method="POST" enctype="multipart/form-data">
        <input type="file" name="data_file">
        <input type="submit" value="Upload & Process Data">
    </form>
    '''

@app.route('/upload', methods=['POST'])
def upload():
    file = request.files.get('data_file')
    if not file:
        return "Error: No file uploaded!", 400
        
    try:
        file_data = file.read()
        
        # CRITICAL VULNERABILITY: Insecure Deserialization via pickle.loads
        # Automatically executes malicious payload embedded within the serialized data.
        data_object = pickle.loads(file_data)
        
        return f"<h3>Success:</h3><p>Data successfully parsed and processed!</p><a href='/'>Back</a>"
    except Exception as e:
        return f"<h3>Data Processing Failed:</h3><pre>{str(e)}</pre><a href='/'>Back</a>"

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
