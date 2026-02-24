@echo off
REM Script para capturar screenshots de las vistas del sistema

REM Crear carpeta de screenshots si no existe
if not exist "public\screenshots" mkdir public\screenshots

REM Esperar a que el servidor esté listo
timeout /t 3

REM Usar PowerShell para capturar screenshots
PowerShell -NoProfile -ExecutionPolicy Bypass -Command "
Add-Type -AssemblyName System.Windows.Forms
Add-Type -AssemblyName System.Drawing

function Take-Screenshot {
    param([string]$filename)
    
    $screen = [System.Windows.Forms.Screen]::PrimaryScreen.Bounds
    $bitmap = New-Object System.Drawing.Bitmap($screen.Width, $screen.Height)
    $graphics = [System.Drawing.Graphics]::FromImage($bitmap)
    $graphics.CopyFromScreen($screen.Location, [System.Drawing.Point]::Empty, $screen.Size)
    $bitmap.Save('$filename')
    $graphics.Dispose()
    $bitmap.Dispose()
    Write-Output 'Captura guardada: $filename'
}

REM Capturar screenshot de login
Write-Output 'Capturando screenshot de login...'
Start-Process 'http://localhost:8082/login'
Start-Sleep -Seconds 3
Take-Screenshot 'public/screenshots/01-login.png'

REM Capturar screenshot de registro
Write-Output 'Capturando screenshot de registro...'
Start-Process 'http://localhost:8082/register'
Start-Sleep -Seconds 3
Take-Screenshot 'public/screenshots/02-register.png'

REM Después de login, capturar productos
Write-Output 'Por favor inicia sesión manualmente y luego presiona Enter...'
Read-Host

Write-Output 'Capturando screenshot de productos...'
Take-Screenshot 'public/screenshots/03-products.png'

Write-Output 'Capturando screenshot de modal de categorías...'
Take-Screenshot 'public/screenshots/04-categories-modal.png'

Write-Output 'Capturas completadas!'
"

echo Screenshots capturadas en public\screenshots\
