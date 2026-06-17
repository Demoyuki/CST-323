# CST-323: Cloud Computing
## Activity 2 — Build Cloud Test Application & Cloud Research
### Activity Report

---

| Field | Details |
|---|---|
| **Student** | Victor Manuel Marrujo Verdugo |
| **Course** | CST-323: Cloud Computing |
| **Professor** | Abdulaziz Alharbi |
| **Institution** | Grand Canyon University, College of Science, Engineering and Technology |
| **Date** | June 2026 |

---


## 1. Updated Application Design

The Bible Verse Searcher application built in Activity 1 is fully complete and meets all
requirements carried forward into Activity 2. No structural changes were made to the
database schema or application architecture. The application is running locally using
PHP Laravel 11 and MySQL 8, with Azure cloud deployment still pending resolution of the
subscription policy errors documented in Activity 1.

### 1.1 Application Summary

| Requirement | Status |
|---|---|
| PHP Laravel framework (BSCP requirement) | ✅ Complete |
| MySQL database | ✅ Complete |
| 3–4 pages with forms and data display | ✅ Complete — 4 pages |
| Full CRUD support | ✅ Complete |
| Bootstrap 5 styling | ✅ Complete |
| Git repository | ✅ Complete |
| Monolog logging | ✅ Complete |
| Screencast demonstration | ✅ Complete — see Section 2 |

### 1.2 Database Design (Unchanged from Activity 1)

#### ER Diagram

```mermaid
erDiagram
    bible_books {
        INT book_id PK
        VARCHAR50 book_name
        VARCHAR3 testament
        INT chapter_count
    }

    bible_verses {
        INT id PK
        INT book_id FK
        INT chapter
        INT verse_num
        VARCHAR800 text
        DATETIME created_at
        DATETIME updated_at
    }

    verse_notes {
        INT note_id PK
        INT verse_id FK
        VARCHAR800 note_text
        DATETIME created_at
        DATETIME updated_at
    }

    bible_books ||--o{ bible_verses : "contains"
    bible_verses ||--o{ verse_notes : "has"
```

#### Table Status

| Table | Status | Notes |
|---|---|---|
| `bible_books` | ✅ Complete | 8 sample books seeded |
| `bible_verses` | ✅ Complete | 9 sample verses seeded |
| `verse_notes` | ✅ Complete | Created via application at runtime |

### 1.3 Application Flow

```mermaid
flowchart TD
    A([" / — Root"]) --> B

    B["📖 Verse List\nGET /verses\nSearch · Filter · Delete"]

    B --> C["➕ Add Verse\nGET /verses/create\nPOST /verses"]
    B --> D["🔍 Verse Detail\nGET /verses/{id}"]
    B -->|inline| E["🗑 Delete Verse\nDELETE /verses/{id}"]

    D --> F["✏️ Edit Verse\nGET /verses/{id}/edit\nPUT /verses/{id}"]
    D --> G["📝 Add Note\nPOST /verses/{id}/notes"]
    D --> H["🗑 Delete Note\nDELETE /verses/{id}/notes/{note}"]

    C -->|redirect on save| B
    F -->|redirect on save| D
    E -->|redirect| B
    G -->|redirect| D
    H -->|redirect| D

    style A fill:#6c757d,color:#fff
    style B fill:#0d6efd,color:#fff
    style C fill:#198754,color:#fff
    style D fill:#0dcaf0,color:#000
    style E fill:#dc3545,color:#fff
    style F fill:#ffc107,color:#000
    style G fill:#198754,color:#fff
    style H fill:#dc3545,color:#fff
```

### 1.4 Pages and Components

| Page | Route | CRUD | Status |
|---|---|---|---|
| Verse List | `GET /verses` | Read All + Search + Delete | ✅ Complete |
| Verse Detail | `GET /verses/{id}` | Read One + Notes CRUD | ✅ Complete |
| Add Verse | `GET /verses/create` | Create | ✅ Complete |
| Edit Verse | `GET /verses/{id}/edit` | Update | ✅ Complete |

| Component | File | Status |
|---|---|---|
| VerseController | `app/Http/Controllers/VerseController.php` | ✅ Complete |
| BibleBook Model | `app/Models/BibleBook.php` | ✅ Complete |
| BibleVerse Model | `app/Models/BibleVerse.php` | ✅ Complete |
| VerseNote Model | `app/Models/VerseNote.php` | ✅ Complete |
| Web Routes | `routes/web.php` | ✅ Complete |
| Blade Layout | `resources/views/layouts/app.blade.php` | ✅ Complete |
| Monolog Config | `config/logging.php` | ✅ Complete |

---

*End of Activity 2 Report — Victor Manuel Marrujo Verdugo — CST-323 Cloud Computing — Prof. Abdulaziz Alharbi*