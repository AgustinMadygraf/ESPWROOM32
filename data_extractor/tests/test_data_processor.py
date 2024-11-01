# tests/test_data_processor.py

import pytest
from datetime import datetime
from src.model.data_processor import DataProcessor

def test_process_data_with_valid_data():
    raw_data = "Peso: 12.5 kg\nVueltas: 5"
    processed_data = DataProcessor.process_data(raw_data)
    
    assert isinstance(processed_data, dict)
    assert "Peso" in processed_data
    assert "Vueltas" in processed_data
    assert "Tiempo" in processed_data
    assert processed_data["Peso"] == 12.5
    assert processed_data["Vueltas"] == 5
    # Verificar que "Tiempo" es una cadena con formato de fecha y hora
    assert datetime.strptime(processed_data["Tiempo"], "%Y-%m-%d %H:%M:%S")

def test_process_data_with_none_data():
    processed_data = DataProcessor.process_data(None)
    assert processed_data is None

def test_process_data_with_invalid_data():
    raw_data = "Peso: No es un número\nVueltas: Cinco"
    processed_data = DataProcessor.process_data(raw_data)
    
    assert "Peso" not in processed_data  # No debe incluir 'Peso' si el formato es incorrecto
    assert "Vueltas" not in processed_data  # No debe incluir 'Vueltas' si el formato es incorrecto
    assert "Tiempo" in processed_data
    assert datetime.strptime(processed_data["Tiempo"], "%Y-%m-%d %H:%M:%S")

def test_process_data_with_missing_fields():
    raw_data = "Peso: 12.5 kg"
    processed_data = DataProcessor.process_data(raw_data)
    
    assert isinstance(processed_data, dict)
    assert "Peso" in processed_data
    assert processed_data["Peso"] == 12.5
    assert "Vueltas" not in processed_data  # Debe faltar si no está en los datos
    assert "Tiempo" in processed_data
    assert datetime.strptime(processed_data["Tiempo"], "%Y-%m-%d %H:%M:%S")
