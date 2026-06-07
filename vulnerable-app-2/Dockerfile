# Dockerfile
FROM python:3.10-slim

# Install sudo for the specific misconfiguration lab setup
RUN apt-get update && apt-get install -y sudo && rm -rf /var/lib/apt/lists/*

# Create a low-privileged system user for the application
RUN useradd -m appuser2
WORKDIR /home/appuser2

RUN pip install --no-cache-dir flask
COPY app.py .
RUN chown -R appuser2:appuser2 /home/appuser2

# SECURITY MISCONFIGURATION: Allow appuser2 to run 'find' as root without password
RUN echo "appuser2 ALL=(ALL) NOPASSWD: /usr/bin/find" >> /etc/sudoers

# Drop privileges to the low-level user
USER appuser2
EXPOSE 5000

CMD ["python", "app.py"]
