### Hexlet tests and linter status:
[![Actions Status](https://github.com/lurc-zmei/php-project-57/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/lurc-zmei/php-project-57/actions)
---

### Render.com
[php-project-57-4blv.onrender.com](https://php-project-57-4blv.onrender.com)
---

### Быстрый старт
 
#### Требования
- Docker и Docker Compose (v2.22+) 
- Make (опционально, для удобного запуска) 
 
**Клонируйте репозиторий и перейдите в папку проекта**

**Вариант 1 (с использованием Make)**
- выполните команду:
```bash
make start
```
  
**Вариант 2**
- создайте файл конфигурации окружения `.env` из `.env.example` и выполните команду для запуска:

```bash
cp -n .env.example .env
docker compose up --build --watch
```
После запуска приложение будет доступно по адресу:  
`http://localhost:8000`
---