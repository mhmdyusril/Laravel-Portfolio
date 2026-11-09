package database

import (
	"log"
	"time"

	"go-portfolio/internal/config"

	"gorm.io/driver/postgres"
	"gorm.io/gorm"
	"gorm.io/gorm/logger"
)

var DB *gorm.DB

func Connect(cfg *config.Config) (*gorm.DB, error) {
	logLevel := logger.Warn
	if cfg.AppEnv == "development" {
		logLevel = logger.Info
	}

	db, err := gorm.Open(postgres.Open(cfg.DatabaseURL), &gorm.Config{
		Logger: logger.Default.LogMode(logLevel),
	})
	if err != nil {
		return nil, err
	}

	sqlDB, err := db.DB()
	if err != nil {
		return nil, err
	}

	// Connection pool settings optimal for Supabase pooler (port 6543)
	sqlDB.SetMaxIdleConns(5)
	sqlDB.SetMaxOpenConns(15)
	sqlDB.SetConnMaxLifetime(10 * time.Minute)

	DB = db
	log.Println("Database connection established successfully")
	return db, nil
}
