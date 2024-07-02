#ESPWROOM32/ESP32Project/models.py
from flask_sqlalchemy import SQLAlchemy

db = SQLAlchemy()

class ESPData(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    timestamp = db.Column(db.DateTime, server_default=db.func.now())
    weight = db.Column(db.Float, nullable=False)
    counter = db.Column(db.Integer, nullable=False)

class ProcessedData(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    timestamp = db.Column(db.DateTime, server_default=db.func.now())
    processed_weight = db.Column(db.Float, nullable=False)
    processed_counter = db.Column(db.Integer, nullable=False)
