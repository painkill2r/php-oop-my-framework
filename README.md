# My PHP Framework

#### 등록일: 2022.02.20(일)

## 개발 환경

1. OS
    - MacOS Monterey 12.2
2. Language
    - PHP 8.0.0
3. Databse
    - Maria DB 10.4.17

## Directory 구조

```bash
├── README.md
├── composer.json
├── ddl.sql
├── index.php
├── src
      ├── Application.php
      ├── Database
      │    └── Adaptor.php
      ├── Http
      │   └── Request.php
      ├── Routing
      │   ├── Middleware.php
      │   ├── RequestContext.php
      │   └── Route.php
      ├── Session
      │   └── DatabaseSessionHandler.php
      └── Support
          ├── ServiceProvider.php
          └── Theme.php
```

### 파일 설명

1. composer.json
    - Composer 정의 파일
2. ddl.sql
    - 데이터베이스 DDL(Data Definition Language, 데이터 정의어) 파일
3. index.php
    - Main 실행 파일
4. src/Database/Adaptor.php
    - Database 연결 및 SQL Query 실행 정의 파일
5. src/Http/Request.php
    - 요청(Request) 정보 조회 정의 파일
6. src/Routing/ReqeustContext.php
    - 요청(Request) 처리기 정의 파일
7. src/Routing/Route.php
    - 라우트 등록 설정 정의 파일
8. src/Routing/Middleware.php
    - Route 실행 전 처리기 정의 파일
9. src/Session/DatabaseSessionHandler.php
    - 데이터베이스를 통한 세션 관리 정의 파일
10. src/Supprot/ServiceProvider.php
    - Application 실행 시 부가적인 처리에 대한 정의 파일
    - 데이터베이스 연결, 세션 시작, 라우팅 설정 등
11. src/Supprot/Theme.php
    - 테마(사용자 View) 정의 파일