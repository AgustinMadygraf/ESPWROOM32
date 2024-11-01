# tests/test_esp32_data_fetcher.py

import pytest
import requests
from requests.exceptions import RequestException
from src.model.esp32_data_fetcher import ESP32DataFetcher

def test_fetch_data_success(requests_mock):
    url = "http://esp32-server/data"
    mock_data = "Peso: 12.5 kg\nVueltas: 5"
    
    # Configura el mock para responder con éxito
    requests_mock.get(url, text=mock_data)
    
    fetcher = ESP32DataFetcher(url)
    data = fetcher.fetch_data()
    
    assert data == mock_data  # Verificar que los datos obtenidos coinciden con los esperados

def test_fetch_data_http_error(requests_mock):
    url = "http://esp32-server/data"
    
    # Configura el mock para responder con un error 404
    requests_mock.get(url, status_code=404)
    
    fetcher = ESP32DataFetcher(url)
    data = fetcher.fetch_data()
    
    assert data is None  # La respuesta debe ser None en caso de error

def test_fetch_data_connection_error(monkeypatch):
    url = "http://esp32-server/data"
    
    # Simula una excepción de conexión
    def mock_get(*args, **kwargs):
        raise RequestException("No se puede conectar al servidor")
    
    monkeypatch.setattr(requests, "get", mock_get)
    
    fetcher = ESP32DataFetcher(url)
    data = fetcher.fetch_data()
    
    assert data is None  # La respuesta debe ser None en caso de error de conexión
