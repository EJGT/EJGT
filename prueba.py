import threading
import requests

def withdraw_money(amount):
    url = 'http://localhost/withdraw.php'
    data = {'amount': amount}
    response = requests.post(url, data=data)
    print(response.text)

threads = []
for i in range(1000):  # Adjust the range as needed for testing
    t = threading.Thread(target=withdraw_money, args=(10,))  # Withdraw 10 units in each request
    t.start()
    threads.append(t)

for t in threads:
    t.join()
