package models

import (
	"encoding/json"
	"time"
)

type PersonalInfo struct {
	ID        uint      `gorm:"primaryKey" json:"id"`
	Name      string    `json:"name"`
	Tagline   string    `json:"tagline"`
	Bio       string    `json:"bio"`
	Email     string    `json:"email"`
	Phone     string    `json:"phone"`
	Location  string    `json:"location"`
	Github    *string   `json:"github,omitempty"`
	Linkedin  *string   `json:"linkedin,omitempty"`
	Photo     *string   `json:"photo,omitempty"`
	CreatedAt time.Time `json:"created_at"`
	UpdatedAt time.Time `json:"updated_at"`
}

func (PersonalInfo) TableName() string {
	return "personal_info"
}

type Skill struct {
	ID        uint      `gorm:"primaryKey" json:"id"`
	Name      string    `json:"name"`
	Category  string    `json:"category"`
	SortOrder int       `json:"sort_order"`
	CreatedAt time.Time `json:"created_at"`
	UpdatedAt time.Time `json:"updated_at"`
}

func (Skill) TableName() string {
	return "skills"
}

type Experience struct {
	ID           uint            `gorm:"primaryKey" json:"id"`
	Company      string          `json:"company"`
	Position     string          `json:"position"`
	StartDate    string          `json:"start_date"`
	EndDate      *string         `json:"end_date,omitempty"`
	IsCurrent    bool            `json:"is_current"`
	Descriptions json.RawMessage `gorm:"type:json" json:"descriptions"`
	SortOrder    int             `json:"sort_order"`
	CreatedAt    time.Time       `json:"created_at"`
	UpdatedAt    time.Time       `json:"updated_at"`
}

func (Experience) TableName() string {
	return "experiences"
}

type Education struct {
	ID          uint      `gorm:"primaryKey" json:"id"`
	Institution string    `json:"institution"`
	Degree      string    `json:"degree"`
	Field       string    `json:"field"`
	StartYear   string    `json:"start_year"`
	EndYear     string    `json:"end_year"`
	CreatedAt   time.Time `json:"created_at"`
	UpdatedAt   time.Time `json:"updated_at"`
}

func (Education) TableName() string {
	return "educations"
}

type Project struct {
	ID           uint            `gorm:"primaryKey" json:"id"`
	Title        string          `json:"title"`
	Role         *string         `json:"role,omitempty"`
	Description  string          `json:"description"`
	Impact       *string         `json:"impact,omitempty"`
	Technologies json.RawMessage `gorm:"type:json" json:"technologies"`
	GithubURL    *string         `json:"github_url,omitempty"`
	DemoURL      *string         `json:"demo_url,omitempty"`
	Image        *string         `json:"image,omitempty"`
	IsFeatured   bool            `json:"is_featured"`
	SortOrder    int             `json:"sort_order"`
	CreatedAt    time.Time       `json:"created_at"`
	UpdatedAt    time.Time       `json:"updated_at"`
}

func (Project) TableName() string {
	return "projects"
}

type Contact struct {
	ID        uint      `gorm:"primaryKey" json:"id"`
	Name      string    `json:"name"`
	Email     string    `json:"email"`
	Subject   string    `json:"subject"`
	Message   string    `json:"message"`
	IsRead    bool      `json:"is_read"`
	CreatedAt time.Time `json:"created_at"`
	UpdatedAt time.Time `json:"updated_at"`
}

func (Contact) TableName() string {
	return "contacts"
}

type PortfolioResponse struct {
	Personal    *PersonalInfo       `json:"personal"`
	Skills      map[string][]Skill  `json:"skills"`
	Experiences []Experience        `json:"experiences"`
	Educations  []Education         `json:"educations"`
	Projects    []Project           `json:"projects"`
	Stats       PortfolioStats      `json:"stats"`
}

type PortfolioStats struct {
	YearsOfExp   int `json:"years_of_exp"`
	ProjectCount int `json:"project_count"`
	SkillCount   int `json:"skill_count"`
	CompanyCount int `json:"company_count"`
}
