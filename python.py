import requests
import json
import random
import time

def generate_random_temperature():
    # Simulate a random temperature between 30.0 and 50.0 degrees Celsius
    return round(random.uniform(30.0, 50.0), 2)

def send_temperature_to_server(temperature):
    url = 'http://server-of-bjarni.pxl.bjth.xyz/api.php'
    data = {'temperature': temperature}
    headers = {'Content-Type': 'application/json'}
    response = requests.post(url, data=json.dumps(data), headers=headers)
    
    if response.status_code == 200:
        print(f"Temperature {temperature} sent successfully!")
    else:
        print(f"Failed to send temperature {temperature}: {response.status_code} - {response.text}")

# Simulate and send temperature every 10 seconds
while True:
    cpu_temp = generate_random_temperature()
    send_temperature_to_server(cpu_temp)
    time.sleep(10)