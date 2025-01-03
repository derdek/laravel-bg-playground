# Laravel + Traefik + frankenphp inside docker compose

1) Зайти в папку cicd та згенерувати ключ, який буде використовуватись для авторизації на github при стягуванні коду
```bash
ssh-keygen -t rsa -b 4096 -C "github_deploy_key"
```
2) Зробити копію інвентаря і заповнити його
```bash
cp cicd/example.inventory.ini cicd/inventory.ini
```
3) Зробити копію змінних середовища для продакшену
```bash
cp .env.example cicd/.env.production
```
4) Зробити копію змінних середовища для локальної розробки
```bash
cp .env.example laravel-project/.env
``` 
5) Додати в інвентар публічкий ключ від ключа, який буде використовуватись для підключення до сервера по ssh.
Також додати айпі адресу сервера, шлях до приватного ключа, який потрібен для підключення під root-ом, 
посилання на репозиторій для клонування по ssh.

6) Встановити ansible
див. https://docs.ansible.com/ansible/latest/installation_guide/installation_distros.html

7) Щоб налаштувати чистий debian сервер, потрібно зайти в папку cicd і виконати наступну команду
```bash
ansible-playbook -i inventory.ini install_packages.yml
```

8) Для будь-якої системи ci/cd достатньо підключитись до серверу по ssh, зайти в папку з проектом і запустити
```bash
bash switch_traffic.sh
```

p.s. Важливо, не видаляти міграції, та не редагувати їх, якщо вона була вже запущена

p.s.2 Важливо вказати хост у dynamic/http.routers.docker-localhost.yml, наприклад example.com

p.s.3 За бажанням налаштувати деплой через jenkins, достатньо підняти докер контейнер будь де, 
встановити плагін ssh-agent, в налаштуваннях credentials додати ключ, який буде використовуватись для підключення до сервера
і при створенні проекту, додати step, з виконанням команди 
```bash 
ssh -o StrictHostKeyChecking=no <cicd user>@<ip> "cd www && bash switch_traffic.sh"
```
А далі, можна додавати тригери, які будуть викликати цей проект, наприклад гітхаб буде робити запит на jenkins webhook, 
або jenkins буде час від часу дивитись чи були зміни в коди 


Скрипти
1) `check_dynamic_main.sh` - цей скрипт перевіряє чи існує файл dynamic/http.routers.docker-localhost.yml, якщо ні, то він його створює
2) `write_last_commit_hash_to_env.sh` - цей скрипт записує хеш останнього коміту в змінну середовища
3) `switch_traffic.sh` - цей скрипт переключає трафік на новий контейнер, якщо той успішно запустився і міграція пройшла вдало
