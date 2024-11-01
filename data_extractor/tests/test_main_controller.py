"""
tests/test_main_controller.py
"""

import pytest
from unittest.mock import MagicMock
from src.controller.main_controller import MainApp

@pytest.fixture
def setup_mocks():
    # Crear mocks para `fetcher`, `processor`, y `sender`
    fetcher = MagicMock()
    processor = MagicMock()
    sender = MagicMock()

    # Configurar datos de prueba para los métodos `fetch_data` y `process_data`
    fetcher.fetch_data.return_value = "mock_raw_data"
    processor.process_data.return_value = {"Peso": 100.0, "Vueltas": 10}

    return fetcher, processor, sender

def test_no_change_in_vueltas(setup_mocks):
    fetcher, processor, sender = setup_mocks

    # Iniciar la aplicación con mocks
    app = MainApp(fetcher, processor, sender, interval=0.01)
    app.previous_vueltas = 10  # Establecer `Vueltas` previamente en 10
    
    # Ejecutar una única iteración de procesamiento
    raw_data = app.fetcher.fetch_data()
    processed_data = app.processor.process_data(raw_data)
    
    if processed_data and app.previous_vueltas != processed_data["Vueltas"]:
        app.sender.send_data(processed_data)
        app.previous_vueltas = processed_data["Vueltas"]

    # Verificar que `send_data` no se llamó porque `Vueltas` no cambió
    sender.send_data.assert_not_called()

def test_change_in_vueltas(setup_mocks):
    fetcher, processor, sender = setup_mocks

    # Cambiar `Vueltas` en el mock para simular un cambio en el contador
    processor.process_data.return_value = {"Peso": 100.0, "Vueltas": 11}

    # Iniciar la aplicación con mocks
    app = MainApp(fetcher, processor, sender, interval=0.01)
    app.previous_vueltas = 10  # Establecer `Vueltas` previamente en 10
    
    # Ejecutar una única iteración de procesamiento
    raw_data = app.fetcher.fetch_data()
    processed_data = app.processor.process_data(raw_data)
    
    if processed_data and app.previous_vueltas != processed_data["Vueltas"]:
        app.sender.send_data(processed_data)
        app.previous_vueltas = processed_data["Vueltas"]

    # Verificar que `send_data` se llamó porque `Vueltas` cambió
    sender.send_data.assert_called_once_with({"Peso": 100.0, "Vueltas": 11})
