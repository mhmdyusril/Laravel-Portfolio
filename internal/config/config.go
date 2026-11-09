package config

import (
	"log"
	"os"

	"github.com/joho/godotenv"
)

type Config struct {
	DatabaseURL string
	Port        string
	AppEnv      string
}

func Load() *Config {
	// Try loading .env (ignore error in production where env is set via cloud platform)
	if err := godotenv.Load(); err != nil {
		_ = godotenv.Load("../../.env")
	}

	dbURL := os.Getenv("DATABASE_URL")
	if dbURL == "" {
		log.Println("WARNING: DATABASE_URL is not set")
	}

	port := os.Getenv("PORT")
	if port == "" {
		port = "8080"
	}

	env := os.Getenv("APP_ENV")
	if env == "" {
		env = "development"
	}

	return &Config{
		DatabaseURL: dbURL,
		Port:        port,
		AppEnv:      env,
	}
}
