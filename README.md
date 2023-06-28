# Introduction

This is a simple PHP app with a ready to test and play with web vulnerabilities.

This project comes with the following vulnerabilities:

- SQL Injection
- Blind SQL Injection
- Header Injection
- Command Injection
- Code Injection
- Authentication bypass injection (using SQL)
- Content injection
- SSRF and LFI (Local file inclusion)

## How to run this project

Simply run the following commands:

```bash
# This will run the web interface and the adminer (formerly phpmyadmin)
docker-compose up -d web adminer
```

And now you can open up the main page and start playing with the vulnerabilities:

```
http://localhost
```
