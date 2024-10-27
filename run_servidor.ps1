
# Script: run_servidor.ps1
# Este script detiene cualquier instancia en ejecucion del servidor Symfony, limpia la cache y reinicia el servidor Symfony en segundo plano.
# Tambien muestra los logs del servidor en tiempo real para monitorear la salida del servidor.
# Para ejecutar este script, simplemente ejecuta `.\run_servidor.ps1` en la terminal de PowerShell.

# Limpia la pantalla
cls

# Detiene cualquier instancia en ejecucion del servidor Symfony
Write-Output "Deteniendo el servidor Symfony si está en ejecucion..."
symfony server:stop

# Pausa breve para asegurarse de que el servidor tiene tiempo de detenerse
Start-Sleep -Seconds 2

# Verifica si el servidor está detenido usando el comando `server:status`
$serverStatus = symfony server:status

# Si el servidor sigue en ejecucion, intenta detener el proceso PHP-CGI manualmente
if ($serverStatus -notmatch "stopped") {
    Write-Output "El servidor sigue en ejecucion. Intentando detenerlo nuevamente..."

    # Verifica si existe algun proceso "php-cgi" antes de intentar detenerlo
    $phpCgiProcess = Get-Process -Name "php-cgi" -ErrorAction SilentlyContinue
    if ($phpCgiProcess) {
        Stop-Process -Name "php-cgi" -Force
        Write-Output "Proceso php-cgi detenido exitosamente."
    } else {
        Write-Output "No se encontro ningun proceso php-cgi en ejecucion."
    }
    Start-Sleep -Seconds 2
} else {
    Write-Output "El servidor se detuvo correctamente."
}

# Limpia la cache del entorno de desarrollo
Write-Output "Limpiando la cache..."
php bin/console cache:clear

# Inicia el servidor Symfony en segundo plano
Write-Output "Iniciando el servidor Symfony..."
symfony serve -d

Write-Output " "
Write-Output "https://127.0.0.1:8000/_profiler"

Write-Output "Mostrando los logs en tiempo real..."

# Muestra los logs del servidor en tiempo real
Start-Process powershell -ArgumentList "symfony server:log" -NoNewWindow
