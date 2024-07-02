#ESPWROOM32/ESP32Project/views.py
import requests
from flask import request, jsonify
from app import app
from models import db, ESPData

@app.route('/fetch-data', methods=['GET'])
def fetch_and_store_data():
    esp_url = "http://192.168.0.184"
    response = requests.get(esp_url)
    
    if response.status_code == 200:
        data = response.json()
        weight = data.get('weight')
        counter = data.get('counter')
        
        if weight is not None and counter is not None:
            new_data = ESPData(weight=weight, counter=counter)
            db.session.add(new_data)
            db.session.commit()
            return jsonify({"status": "success"}), 200
        else:
            return jsonify({"status": "error", "message": "Invalid data format"}), 400
    else:
        return jsonify({"status": "error", "message": "Failed to fetch data"}), 500
