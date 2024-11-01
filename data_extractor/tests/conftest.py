# tests/conftest.py

import pytest
from src.view.main_view import run_main
from src.model import data_processor
from src.model import esp32_data_fetcher
from src.model import php_server_sender
from src.controller.main_controller import MainApp
from src.logs.config_logger import LoggerConfigurator


@pytest.fixture(scope="session")
def app():
    """Fixture que inicializa la aplicación para pruebas."""
    # Inicializamos cualquier configuración global si es necesario para pruebas
    yield run_main  # Usamos `run_main` como la aplicación que vamos a probar

@pytest.fixture(scope="function")
def client(app):
    """Mock para simular el cliente de prueba."""
    # Si tienes un cliente de prueba HTTP o similar, configúralo aquí
    # Para efectos de este código de ejemplo, lo dejamos como un placeholder.
    yield app  # Proporciona la app para pruebas (aquí sería `run_main`)

@pytest.fixture(scope="function")
def setup_and_teardown():
    """Ejecuta configuraciones de prueba y limpia después de cada prueba."""
    # Agrega aquí cualquier configuración que necesites antes de cada prueba
    yield
    # Limpieza después de cada prueba (si es necesario)
