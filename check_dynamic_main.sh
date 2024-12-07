#!/bin/bash

# Шлях до файлу
FILE_PATH="dynamic/http.routers.docker-localhost.yml"
EXAMPLE_FILE_PATH="dynamic/example-docker-localhost.yml"

# Перевірка на існування файлу
if [ ! -f "$FILE_PATH" ]; then
  echo "File $FILE_PATH does not exist. Creating it..."

  # Створення директорії, якщо вона не існує
  mkdir -p $(dirname "$FILE_PATH")

  # копіювання файла
  cp $EXAMPLE_FILE_PATH $FILE_PATH

  echo "File $FILE_PATH created successfully."
else
  echo "File $FILE_PATH already exists."
fi
