package handler

import (
	"log"
	"net/http"
	"sync"

	"go-portfolio/internal/config"
	"go-portfolio/internal/database"
	"go-portfolio/internal/handler"

	"github.com/go-chi/chi/v5"
	"github.com/go-chi/chi/v5/middleware"
	"github.com/go-chi/cors"
)

var (
	router http.Handler
	once   sync.Once
)

func initRouter() {
	cfg := config.Load()

	// Connect Database
	_, err := database.Connect(cfg)
	if err != nil {
		log.Printf("ERROR: Database connection failed: %v", err)
	}

	r := chi.NewRouter()

	r.Use(middleware.RequestID)
	r.Use(middleware.RealIP)
	r.Use(middleware.Recoverer)

	r.Use(cors.Handler(cors.Options{
		AllowedOrigins:   []string{"https://*", "http://*"},
		AllowedMethods:   []string{"GET", "POST", "PUT", "DELETE", "OPTIONS"},
		AllowedHeaders:   []string{"Accept", "Authorization", "Content-Type", "X-CSRF-Token"},
		ExposedHeaders:   []string{"Link"},
		AllowCredentials: true,
		MaxAge:           300,
	}))

	// API Routes (mounted under both /api and root because Vercel may rewrite /api/*)
	mountRoutes := func(sub chi.Router) {
		sub.Get("/health", handler.HealthCheck)
		sub.Get("/portfolio", handler.GetPortfolio)
		sub.Post("/contact", handler.SubmitContact)
	}

	r.Route("/api", mountRoutes)
	mountRoutes(r)

	router = r
}

// Handler is the single serverless entrypoint for Vercel
func Handler(w http.ResponseWriter, r *http.Request) {
	once.Do(initRouter)
	router.ServeHTTP(w, r)
}
