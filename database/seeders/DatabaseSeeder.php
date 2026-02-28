<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PersonalInfo;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::firstOrCreate(
            ['email' => 'admin@portfolio.com'],
            [
                'name' => 'Muhamad Yusril',
                'password' => Hash::make('password'),
            ]
        );

        // Personal Info
        PersonalInfo::firstOrCreate(['email' => 'muh.yusril098@gmail.com'], [
            'name' => 'Muhamad Yusril',
            'tagline' => 'Software Developer (Full Stack)',
            'bio' => 'Accomplished Software Developer with 3+ years of experience in architectural design of web applications using Laravel. Proven track record in maintaining critical institutional systems for the Indonesian National Police (Polri), with a focus on system reliability, data integrity, and strategic cross-agency data integration (SPPT-TI).',
            'email' => 'muh.yusril098@gmail.com',
            'phone' => '+62 812 8499 3957',
            'location' => 'Jakarta, Indonesia',
            'github' => 'https://github.com/mhmdyusril',
            'linkedin' => 'https://linkedin.com/in/muhamad-yusril/',
            'photo' => null,
        ]);

        // Skills
        $skills = [
            // Full Stack
            ['name' => 'Laravel', 'category' => 'Full Stack', 'sort_order' => 1],
            ['name' => 'MVC & Blade', 'category' => 'Full Stack', 'sort_order' => 2],
            ['name' => 'Eloquent ORM', 'category' => 'Full Stack', 'sort_order' => 3],
            ['name' => 'PHP', 'category' => 'Full Stack', 'sort_order' => 4],
            ['name' => 'JavaScript', 'category' => 'Full Stack', 'sort_order' => 5],
            ['name' => 'HTML5', 'category' => 'Full Stack', 'sort_order' => 6],
            ['name' => 'CSS3', 'category' => 'Full Stack', 'sort_order' => 7],
            // API
            ['name' => 'RESTful API', 'category' => 'API & Integration', 'sort_order' => 1],
            ['name' => 'API Development', 'category' => 'API & Integration', 'sort_order' => 2],
            ['name' => 'API Consumption', 'category' => 'API & Integration', 'sort_order' => 3],
            ['name' => 'Cross-Agency Integration', 'category' => 'API & Integration', 'sort_order' => 4],
            // Database
            ['name' => 'PostgreSQL', 'category' => 'Database', 'sort_order' => 1],
            ['name' => 'Query Optimization', 'category' => 'Database', 'sort_order' => 2],
            ['name' => 'Performance Tuning', 'category' => 'Database', 'sort_order' => 3],
            // Auth
            ['name' => 'Laravel Authentication', 'category' => 'Security', 'sort_order' => 1],
            ['name' => 'RBAC', 'category' => 'Security', 'sort_order' => 2],
            ['name' => 'Middleware', 'category' => 'Security', 'sort_order' => 3],
            // Infrastructure
            ['name' => 'Linux (Nginx)', 'category' => 'Infrastructure', 'sort_order' => 1],
            ['name' => 'Git / GitHub / GitLab', 'category' => 'Infrastructure', 'sort_order' => 2],
            ['name' => 'Bootstrap', 'category' => 'Infrastructure', 'sort_order' => 3],
        ];

        foreach ($skills as $skill) {
            Skill::firstOrCreate(['name' => $skill['name']], $skill);
        }

        // Experiences
        Experience::firstOrCreate(['company' => 'PT Trimitra Brata Jaya'], [
            'company' => 'PT Trimitra Brata Jaya',
            'position' => 'Software Developer (Full Stack)',
            'start_date' => 'January 2023',
            'end_date' => null,
            'is_current' => true,
            'descriptions' => [
                'Lead Developer (Full Stack) for the ICELL KORLANTAS POLRI platform, ensuring high-availability backend logic and responsive frontend updates.',
                'System Modernization: Successfully transformed file-based data entry into structured dynamic input forms, significantly improving data precision.',
                'Strategic Integration: Orchestrated seamless data bridges between ICELL and key police systems, including IRSMS KORLANTAS, TAR KORLANTAS, and DIVTIK POLRI.',
                'National Compliance: Implemented REST API integrations with EMP BARESKRIM POLRI to support national data exchange standards (SPPT-TI).',
                'Database Scaling: Optimized PostgreSQL to maintain stability under high-volume institutional data traffic.',
            ],
            'sort_order' => 1,
        ]);

        Experience::firstOrCreate(['company' => 'PT Avalogix Mitra Solusi'], [
            'company' => 'PT Avalogix Mitra Solusi',
            'position' => 'Software Developer',
            'start_date' => 'March 2022',
            'end_date' => 'December 2022',
            'is_current' => false,
            'descriptions' => [
                'Core Development: Engineered fundamental CRUD modules and data management features for the ICELL KORLANTAS POLRI application.',
                'Maintenance: Executed rigorous bug mitigation and performance tuning for both frontend and backend components.',
                'Collaboration: Worked with cross-functional teams to align system functionality with complex institutional requirements.',
            ],
            'sort_order' => 2,
        ]);

        // Education
        Education::firstOrCreate(['institution' => 'STMK JAKARTA STIbK'], [
            'institution' => 'STMK JAKARTA STIbK',
            'degree' => 'Bachelor of Information Systems',
            'field' => 'Information Systems',
            'start_year' => '2017',
            'end_year' => '2021',
        ]);

        // Projects
        Project::firstOrCreate(['title' => 'ICELL KORLANTAS POLRI'], [
            'title' => 'ICELL KORLANTAS POLRI',
            'role' => 'Full Stack Software Developer',
            'description' => 'Strategic Data Management platform integrated with the Indonesian National Police (Polri) criminal justice system.',
            'impact' => 'Developed a centralized data hub integrated with the national criminal justice system (SPPT-TI), enabling seamless data exchange across multiple police systems nationwide.',
            'technologies' => ['Laravel', 'PostgreSQL', 'REST API', 'Bootstrap', 'Git'],
            'github_url' => null,
            'demo_url' => null,
            'is_featured' => true,
            'sort_order' => 1,
        ]);
    }
}
