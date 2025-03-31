# Task Management App (Laravel)

**A secure task management application with role-based access control (Admin/User).**

----------

## 🔑  **Key Features**

### **1. User Authentication & Authorization**

 -   **Login/Registration**: Secure auth using Laravel Breeze
    
 -   **Role-Based Access**:
    
    -   **Admins**: Full CRUD access to all tasks
        
    -   **Users**: Can only manage their own tasks
        
 -   **Middleware Protection**:
 

    **php**
                  Route::middleware(['auth', 'admin'])->group(function () { ... });

    

### **2. Task Management (CRUD)**

    -   Create, edit, delete tasks with validation
        
    $request->validate([
        'title' => 'required|max:255',
        'status' => 'required|in:pending,completed'
    ]);
    
-   **Admin Dashboard**:
    
    -   View all tasks/users
        
    -   Stats (total tasks, completed tasks, user counts)
        

### **3. Automated Redirects**

-   Admins →  `/admin/dashboard`
    
-   

    Users →  `/dashboard`
       
         protected function authenticated(Request $request, $user)
            {
                return $user->isAdmin() 
                    ? redirect()->route('admin.dashboard') 
                    : redirect()->intended('/');
            }
    

----------

## 🔒  **Security Precautions**

### **1. Data Protection**

    -  BCrypt Hashing:  All passwords hashed
        User::create(['password' => Hash::make('...')]);

    
-   **Mass Assignment Protection**:

    
protected $fillable = ['name', 'email', 'password', 'role'];
    

### **2. CSRF & Session Protection**

    -   CSRF tokens enforced in all forms:
         '<form method="POST"> @csrf </form>'
       
-   Session timeout: Default 120 minutes (configurable in  `.env`)
    

### **3. Secure Routing**

    -   Auth-guarded routes:
    Route::middleware('auth')->group(function () { ... });

        
    -   Role checks in controllers:
    if ($task->user_id !== auth()->id()) abort(403);

    

### **4. Security Headers**

    -   Enabled via middleware:
        
    \App\Http\Middleware\SecureHeaders::class
    (Sets XSS protection, no-sniff, etc.)
    

----------

## 🛠️  **Installation**

    1.  Clone the repo:
    
    git clone https://github.com/your-repo/task-app.git
    
 -  Install dependencies:
    
 

        
        composer install
        npm install
    

 -  Configure  `.env`:
 - 

    ini
           DB_DATABASE=your_db
           DB_USERNAME=your_user
           DB_PASSWORD=your_password

    
 -  Migrate & seed:        

 `php artisan migrate --seed`



    

----------

## 🚨  **Critical Security Notes**

-   **Never commit  `.env`**  (contains secrets)
    
-   **Rotate  `APP_KEY`**  on production:
- 
  `php artisan key:generate`

    
-   **Limit admin access**:
    
    

> php
>     
>     
>     User::where('role', 'admin')->update(['role' => 'user']); // Demote all if breached

    

----------

## 📜  **License**

MIT License - See  [LICENSE](https://license/)  for details.

**Report security issues to**:  [security@yourdomain.com](https://mailto:security@yourdomain.com/)

----------

**Enjoy the app!**  🎉  
For feature requests, open an issue on GitHub.
