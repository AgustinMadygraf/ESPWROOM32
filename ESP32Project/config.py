#ESPWROOM32/ESP32Project/config.py

class Config:
    SQLALCHEMY_DATABASE_URI = 'mysql+pymysql://tu_usuario:tu_contraseña@localhost/nombre_de_tu_base_de_datos'
    SQLALCHEMY_TRACK_MODIFICATIONS = False
