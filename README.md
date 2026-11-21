# FlipPlay Laravel API

Prototype API untuk studi kasus FlipPlay menggunakan Laravel, Eloquent, migration, Form Request, dan API Resource.

## Entitas

- `Media`: judul, jenis, genre, tahun rilis, vibe, dan URL sampul.
- `User`: entitas pengguna bawaan Laravel.
- Relasi many-to-many `Media <-> User` melalui tabel pivot `media_user`.

## Menjalankan

```powershell
php artisan migrate:fresh --seed
php artisan serve
```

Base URL lokal: `http://127.0.0.1:8000/api`

## Endpoint CRUD Media

| Method | Endpoint | Fungsi |
|---|---|---|
| GET | `/api/media?title=Naruto` | Daftar media dan filter judul |
| POST | `/api/media` | Tambah media |
| GET | `/api/media/{id}` | Detail media beserta pengguna koleksi |
| PATCH | `/api/media/{id}` | Perbarui media |
| DELETE | `/api/media/{id}` | Hapus media |

Contoh body POST/PATCH:

```json
{
  "title": "Attack on Titan",
  "type": "Anime",
  "genre": "Aksi",
  "release_year": 2013,
  "vibe": "Intense",
  "cover_url": "https://example.com/aot.jpg"
}
```

## Custom Collection Action

| Method | Endpoint | Fungsi |
|---|---|---|
| GET | `/api/users/{userId}/media` | Tampilkan koleksi pengguna |
| POST | `/api/users/{userId}/media/{mediaId}` | Tambahkan media ke koleksi |
| DELETE | `/api/users/{userId}/media/{mediaId}` | Hapus media dari koleksi |

Menambahkan media yang sama dua kali menghasilkan HTTP `409 Conflict`.

## Pengujian

```powershell
php artisan test tests/Feature/MediaApiTest.php
php artisan route:list --path=api
```
