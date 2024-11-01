# tests/test_main_view.py

import pytest
from unittest.mock import patch, MagicMock
from src.view.main_view import run_main
from src.controller.main_controller import MainApp
from src.model.esp32_data_fetcher import ESP32DataFetcher
from src.model.data_processor import DataProcessor
from src.model.php_server_sender import PHPServerSender

@patch("src.view.main_view.LoggerConfigurator")
@patch("src.view.main_view.ESP32DataFetcher")
@patch("src.view.main_view.DataProcessor")
@patch("src.view.main_view.PHPServerSender")
@patch("src.view.main_view.MainApp")
@patch("src.view.main_view.os.system")
def test_run_main(mock_os_system, mock_main_app, mock_php_sender, mock_data_processor, mock_fetcher, mock_logger_configurator):
    # Mocks de dependencias y sus comportamientos
    mock_os_system.return_value = None
    mock_logger = MagicMock()
    mock_logger_configurator.return_value.configure.return_value = mock_logger

    # Mock de la clase principal MainApp
    mock_app_instance = MagicMock()
    mock_main_app.return_value = mock_app_instance
    
    # Ejecutar la función principal
    run_main()
    
    # Verificar que el comando `os.system('cls')` fue llamado
    mock_os_system.assert_called_once_with('cls')
    
    # Verificar que el logger fue configurado correctamente
    mock_logger_configurator.return_value.configure.assert_called_once()
    mock_logger.debug.assert_called_once_with("Logger configurado correctamente al inicio del servidor.")
    mock_logger.info.assert_any_call("Iniciando la aplicación principal")

    # Verificar la inyección de dependencias en MainApp
    mock_main_app.assert_called_once_with(
        mock_fetcher.return_value, mock_data_processor.return_value, mock_php_sender.return_value, interval=5
    )
    
    # Verificar que la aplicación fue iniciada y finalizada
    mock_app_instance.run.assert_called_once()
    mock_logger.info.assert_any_call("Aplicación principal finalizada")
