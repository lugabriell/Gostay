import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart
import sys
import json

smtp_server = 'smtp.gmail.com'
smtp_port = 587
sender_email = 'lucas74126@gmail.com'
password = 'wejz quik hhih fuus'


def enviodeemail(emails, chave):
    mensagem1 = "Código de verificação do Ids Ead"

    server = smtplib.SMTP(smtp_server, smtp_port)
    server.starttls()
    server.login(sender_email, password)

    enviados = 0

    for email in emails:
        message = MIMEMultipart()
        message['From'] = sender_email
        message['To'] = email
        message['Subject'] = mensagem1

        message.attach(MIMEText(chave, 'plain'))

        server.sendmail(sender_email, email, message.as_string())
        enviados += 1

    server.quit()
    return enviados
if __name__ == "__main__":
    try:
        # lê JSON vindo do STDIN (PHP)
        raw = sys.stdin.read()

        dados = json.loads(raw)

        emails = dados["emails"]
        chave = dados["chave"]

        total = enviodeemail(emails, chave)

        print(json.dumps({
            "status": "ok",
            "enviados": total
        }))

    except Exception as e:
        print(json.dumps({
            "status": "erro",
            "mensagem": str(e)
        }))
