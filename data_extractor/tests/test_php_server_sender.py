"""
tests/test_php_server_sender.py
"""

import pytest  # Asegúrate de importar pytest
import requests
from src.model.php_server_sender import PHPServerSender

@pytest.fixture
def sender():
    # URL de prueba
    return PHPServerSender("https://www.example.com/test_endpoint")

def test_send_data_success(requests_mock, sender):
    # Configurar el mock para una respuesta exitosa
    requests_mock.get("https://www.example.com/test_endpoint", text="Datos insertados correctamente", status_code=200)
    
    # Datos de prueba
    data = {
        "Peso": 100.5,
        "Vueltas": 10
    }

    # Llamar al método y verificar que no lanza excepción
    response = sender.send_data(data)
    assert response is None  # `send_data` no retorna nada

def test_send_data_no_data_warning(sender, caplog):
    # Configurar caplog para capturar mensajes WARNING
    caplog.set_level("WARNING")

    # Llamar al método con `None` para verificar el warning
    sender.send_data(None)

    # Comprobar que se ha registrado un warning en el logger
    assert any(record.levelname == "WARNING" and "No hay datos para enviar" in record.message for record in caplog.records)

def test_send_data_http_error(requests_mock, sender, caplog):
    # Configurar el mock para una respuesta de error
    requests_mock.get("https://www.example.com/test_endpoint", status_code=500, text="Error del servidor")
    
    # Datos de prueba
    data = {
        "Peso": 50.2,
        "Vueltas": 5
    }

    # Llamar al método y capturar los logs de error
    sender.send_data(data)

    # Verificar que se registró un error en el logger
    assert any(record.levelname == "ERROR" and "Error al enviar datos al servidor PHP" in record.message for record in caplog.records)
