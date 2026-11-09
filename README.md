# 🚀 Go Portfolio CMS & Serverless API

Modern, high-performance personal portfolio platform and API built with **Golang (Chi / GORM)**, **PostgreSQL (Supabase)**, and a lightweight **Jamstack Frontend**.

Designed with **Clean Architecture** principles and deployed natively to **Vercel Serverless Functions**.

---

## ⚡ Highlights
- **Sub-millisecond Serverless Runtime:** Built on native Go runtime instead of containerized PHP-FPM, eliminating cold-starts on serverless platforms.
- **Clean Decoupled Architecture:** Single API gateway providing normalized portfolio endpoints and asynchronous contact handling.
- **PostgreSQL Connection Pooling:** Optimized GORM queries against pooled Supabase PostgreSQL database.
- **Client-Side Bilingual & Theme Engine:** Zero-latency instantaneous switching between English and Indonesian with persistent Dark/Light mode.
- **100% Responsive Glassmorphism UI:** Tailored with Tailwind CSS and CSS backdrop filters.

---

## 📁 Project Structure

```text
go-portfolio/
├── api/
│   └── index.go            # Vercel Serverless Function entrypoint
├── cmd/
│   └── server/
│       └── main.go         # Local standalone HTTP server (http://localhost:8080)
├── internal/
│   ├── config/             # Environment & configuration loader
│   ├── database/           # PostgreSQL connection pool with GORM
│   ├── models/             # GORM models matching PostgreSQL schema
│   └── handler/            # HTTP Handlers (Portfolio, Contact, Health)
├── public/                 # Static Frontend (Served via CDN)
│   ├── index.html          # Clean HTML template
│   ├── css/
│   ├── js/
│   │   └── app.js          # API client, dynamic renderer, bilingual toggle
│   └── favicon.svg
├── vercel.json             # Vercel deployment routing configuration
├── go.mod
└── go.sum
```

---

## 🛠️ API Endpoints

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/api/health` | Healthcheck and PostgreSQL connectivity status |
| `GET` | `/api/portfolio` | Consolidated portfolio payload (Personal, Skills, Projects, Experiences, Educations) |
| `POST` | `/api/contact` | Store incoming message from contact form to database |

---

## 💻 Local Development

### Prerequisites
- Go 1.21+ (Tested on Go 1.25)
- PostgreSQL Database URL

### Setup
1. Clone the repository and configure `.env`:
   ```bash
   cp .env.example .env
   # Add your DATABASE_URL in .env
   ```
2. Run local development server:
   ```bash
   go run cmd/server/main.go
   ```
3. Open `http://localhost:8080` in your browser.

---

## 🚢 Deployment to Vercel

```bash
vercel deploy --prod
```
Vercel automatically compiles `api/index.go` using the official Go serverless builder and maps static files in `public/` to the edge CDN.
