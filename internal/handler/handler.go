package handler

import (
	"encoding/json"
	"net/http"
	"strings"
	"time"

	"go-portfolio/internal/database"
	"go-portfolio/internal/models"
)

type ContactRequest struct {
	Name    string `json:"name"`
	Email   string `json:"email"`
	Subject string `json:"subject"`
	Message string `json:"message"`
}

func HealthCheck(w http.ResponseWriter, r *http.Request) {
	sqlDB, err := database.DB.DB()
	dbStatus := "connected"
	if err != nil || sqlDB.Ping() != nil {
		dbStatus = "disconnected"
	}

	w.Header().Set("Content-Type", "application/json")
	json.NewEncoder(w).Encode(map[string]interface{}{
		"status":    "ok",
		"database":  dbStatus,
		"timestamp": time.Now().Format(time.RFC3339),
		"runtime":   "Go 1.25 Serverless API",
	})
}

func GetPortfolio(w http.ResponseWriter, r *http.Request) {
	db := database.DB

	var personal models.PersonalInfo
	if err := db.First(&personal).Error; err != nil {
		personal = models.PersonalInfo{
			Name:     "Muhamad Yusril",
			Tagline:  "Software Developer (Full Stack)",
			Location: "Jakarta, Indonesia",
			Bio:      "Software Developer dengan 5 tahun pengalaman dalam pengembangan web modern dan database relasional.",
		}
	}

	var rawSkills []models.Skill
	db.Order("category ASC, sort_order ASC").Find(&rawSkills)

	// Group skills by category
	skillsMap := make(map[string][]models.Skill)
	for _, s := range rawSkills {
		skillsMap[s.Category] = append(skillsMap[s.Category], s)
	}

	var experiences []models.Experience
	db.Order("sort_order ASC").Find(&experiences)

	var educations []models.Education
	db.Find(&educations)

	var projects []models.Project
	db.Order("sort_order ASC").Find(&projects)

	response := models.PortfolioResponse{
		Personal:    &personal,
		Skills:      skillsMap,
		Experiences: experiences,
		Educations:  educations,
		Projects:    projects,
		Stats: models.PortfolioStats{
			YearsOfExp:   5,
			ProjectCount: len(projects),
			SkillCount:   len(rawSkills),
			CompanyCount: len(experiences),
		},
	}

	w.Header().Set("Content-Type", "application/json")
	w.Header().Set("Cache-Control", "public, s-maxage=60, stale-while-revalidate=300")
	json.NewEncoder(w).Encode(response)
}

func SubmitContact(w http.ResponseWriter, r *http.Request) {
	var req ContactRequest
	if err := json.NewDecoder(r.Body).Decode(&req); err != nil {
		w.Header().Set("Content-Type", "application/json")
		w.WriteHeader(http.StatusBadRequest)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "Format data tidak valid",
		})
		return
	}

	req.Name = strings.TrimSpace(req.Name)
	req.Email = strings.TrimSpace(req.Email)
	req.Subject = strings.TrimSpace(req.Subject)
	req.Message = strings.TrimSpace(req.Message)

	if req.Name == "" || req.Email == "" || req.Subject == "" || req.Message == "" {
		w.Header().Set("Content-Type", "application/json")
		w.WriteHeader(http.StatusUnprocessableEntity)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "Semua kolom (nama, email, subjek, pesan) wajib diisi.",
		})
		return
	}

	contact := models.Contact{
		Name:      req.Name,
		Email:     req.Email,
		Subject:   req.Subject,
		Message:   req.Message,
		IsRead:    false,
		CreatedAt: time.Now(),
		UpdatedAt: time.Now(),
	}

	if err := database.DB.Create(&contact).Error; err != nil {
		w.Header().Set("Content-Type", "application/json")
		w.WriteHeader(http.StatusInternalServerError)
		json.NewEncoder(w).Encode(map[string]string{
			"error": "Gagal menyimpan pesan ke database",
		})
		return
	}

	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(http.StatusCreated)
	json.NewEncoder(w).Encode(map[string]interface{}{
		"success": true,
		"message": "Pesan Anda berhasil terkirim! Terima kasih telah menghubungi saya.",
	})
}
