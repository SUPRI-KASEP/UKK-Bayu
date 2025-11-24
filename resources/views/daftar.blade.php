<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex; justify-content: center; align-items: center;
            min-height: 100vh;
        }
        .register-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            width: 100%; max-width: 400px;
        }
        .header { text-align: center; margin-bottom: 1.5rem; }
        .header h2 { color: #333; }
        .header p { color: #666; font-size: 0.9rem; }

        .form-group { margin-bottom: 1.2rem; }
        .form-group label {
            display: block; margin-bottom: 0.5rem; color: #333; font-weight: 500;
        }
        .form-group input {
            width: 100%; padding: 0.75rem;
            border: 2px solid #e1e5e9; border-radius: 5px;
            font-size: 1rem; transition: .3s;
        }
        .form-group input:focus {
            outline: none; border-color: #667eea;
        }
        .btn {
            width: 100%; padding: 0.75rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white; border: none;
            border-radius: 5px; cursor: pointer; font-size: 1rem;
        }
        .btn:hover { transform: translateY(-2px); }

        .error-message {
            background: #fee; color: #c33;
            padding: 0.75rem; border-radius: 5px;
            border: 1px solid #fcc; margin-bottom: 1rem;
        }

        .login {
            text-align: end; margin-top: .5rem;
        }
        .login a {
            text-decoration: none; font-size: 10px; color: blue;
        }
        .login a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="register-container">
        <div class="header">
            <h2>Daftar</h2>
            <p>Buat akun baru anda</p>
        </div>

        @if($errors->any())
            <div class="error-message">
                @foreach($errors->all() as $err)
                    <p>{{ $err }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('daftar.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button class="btn">Daftar</button>
        </form>

        <div class="login">
            <a href="{{ route('login') }}">Sudah punya akun? Login</a>
        </div>

    </div>

</body>
</html>
