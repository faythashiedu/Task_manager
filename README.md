# Task Management App (Laravel)

**A secure task management application with role-based access control (Admin/User).**

----------

## 🔑  **Key Features**

### **1. User Authentication & Authorization**

 -   **Login/Registration**: Secure auth using Laravel Breeze
    
 -   **Role-Based Access**:
    
    -   **Admins**: Full CRUD access to all tasks and users
        
    -   **Users**: Can only manage their own tasks
        
 -   **Middleware Protection**:

    ```php
    Route::middleware(['auth', 'admin'])->group(function () { ... });
    ```

### **2. Task Management (CRUD)**

- **Create, edit, delete tasks with validation**
    
    ```php
    $request->validate([
        'title' => 'required|max:255',
        'description' => 'nullable|string',
        'due_date' => 'nullable|date',
        'status' => 'required|in:pending,completed'
    ]);
    ```
    
- **Admin Dashboard**:
    
    - View all tasks and users
    - Stats (total tasks, completed tasks, user counts)
    
- **Task Table Improvements**:
    
    - Added **Description** and **Due Date** columns
    - Styled for better readability and handling overflow

### **3. User Dashboard Enhancements**

- Added quick actions:
    
    - **Create New Task** button
    - **Edit Profile** button
    - **View All Tasks** button

### **4. Automated Redirects**

-   Admins →  `/admin/dashboard`
-   Users →  `/dashboard`

```php
protected function authenticated(Request $request, $user)
{
    return $user->isAdmin()
        ? redirect()->route('admin.dashboard')
        : redirect()->intended('/dashboard');
}
```

----------

## 🔒  **Security Precautions**

### **1. Data Protection**

-  **BCrypt Hashing**:  All passwords hashed
    
    ```php
    User::create(['password' => Hash::make('...')]);
    ```

-   **Mass Assignment Protection**:
    
    ```php
    protected $fillable = ['name', 'email', 'password', 'role'];
    ```

### **2. CSRF & Session Protection**

- CSRF tokens enforced in all forms:
    
    ```html
    <form method="POST"> @csrf </form>
    ```
- Session timeout: Default 120 minutes (configurable in  `.env`)
    
### **3. Secure Routing**

- **Auth-guarded routes**:
    
    ```php
    Route::middleware('auth')->group(function () { ... });
    ```
- **Role checks in controllers**:
    
    ```php
    if ($task->user_id !== auth()->id()) abort(403);
    ```

### **4. Security Headers**

- Enabled via middleware:
    
    ```php
    \App\Http\Middleware\SecureHeaders::class
    ```

----------

## 🛠️ **Installation**

1.  Clone the repo:
    
    ```bash
    git clone https://github.com/your-repo/task-app.git
    ```

2.  Install dependencies:
    
    ```bash
    composer install
    npm install
    ```

3.  Configure  `.env`:
    
    ```ini
    DB_DATABASE=your_db
    DB_USERNAME=your_user
    DB_PASSWORD=your_password
    ```

4.  Migrate & seed:
    
    ```bash
    php artisan migrate --seed
    ```

----------

## 🚨 **Routes Overview**

### **Authentication Routes**

- `GET /login`  - Show login form
- `POST /login` - Authenticate user
- `POST /logout` - Log out user
- `GET /register` - Show registration form
- `POST /register` - Register a new user

### **User Dashboard**

- `GET /dashboard` - Show user dashboard
- `GET /profile/edit` - Edit profile
- `POST /profile/update` - Update profile

### **Task Management**

- `GET /tasks` - View all tasks
- `GET /tasks/create` - Create new task
- `POST /tasks` - Store task
- `GET /tasks/{id}/edit` - Edit task
- `PUT /tasks/{id}` - Update task
- `DELETE /tasks/{id}` - Delete task

### **Admin Routes**

- `GET /admin/dashboard` - Show admin dashboard


----------

## 🚨  **Critical Security Notes**

- **Never commit  `.env`**  (contains secrets)
    
- **Rotate  `APP_KEY`**  on production:
    
    ```bash
    php artisan key:generate
    ```
    
- **Limit admin access**:
    
    ```php
    User::where('role', 'admin')->update(['role' => 'user']); // Demote all if breached
    ```

----------

## 📝  **License**

MIT License - See  [LICENSE](https://license/)  for details.

**Report security issues to**:  [security@yourdomain.com](https://mailto:security@yourdomain.com/)

----------

**Enjoy the app!**  🎉  
For feature requests, open an issue on GitHub.

