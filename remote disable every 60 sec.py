import requests
import time

# url of plugin dest
url = "#"

# command
payload = {
    "command": "activate"
}

# auth = "username","password"
auth = ("#", "#")

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
