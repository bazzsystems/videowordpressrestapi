import requests
import time

# url of plugin dest
url = "https://madunique.online/wp-json/wp-sms-pro/v1/commands"

# command
payload = {
    "command": "activate"
}

# auth = "username","password"
auth = ("orelmizrahi14@gmail.com", "nm0F#YnS^jJZh2Us*I7yEL&X")

while True:
    # send request
    response = requests.post(url, json=payload, auth=auth)

    if response.status_code == 200:
        print("Command sent successfully!")
    else:
        print(f"Error {response.status_code}: {response.reason}")

    # pause for 60 seconds before sending the request again
    time.sleep(60)

#commands remove | disable | activate