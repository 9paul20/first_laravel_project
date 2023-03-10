<?php

use App\Post;
use App\Category;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('posts');
        User::truncate();
        Category::truncate();
        Tag::truncate();
        Post::truncate();
        Role::truncate();
        Permission::truncate();

        $category = new Category;
        $category->name = 'Categoria 1';
        $category->save();

        $category = new Category;
        $category->name = 'Categoria 2';
        $category->save();

        $category = new Category;
        $category->name = 'Categoria 3';
        $category->save();

        $category = new Category;
        $category->name = 'Categoria 4';
        $category->save();

        $post = new Post;
        $post->title = "Primer Post";
        $post->url = str_slug("Primer Post");
        $post->excerpt = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do";
        $post->body = "<p>Lorem ipsum dolor sit amet, consectetur adip</p>";
        $post->iframe = "";
        $post->published_at = Carbon::now()->subDays()->format('Y-m-d H:i:s');
        $post->category_id = 1;
        $post->user_id = 1;
        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'Tag 1']));

        $post = new Post;
        $post->title = "Segundo Post";
        $post->url = str_slug("Segundo Post");
        $post->excerpt = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do";
        $post->body = "<p>Lorem ipsum dolor sit amet, consectetur adip</p>";
        $post->iframe = "";
        $post->published_at = Carbon::now()->subDays(2)->format('Y-m-d H:i:s');
        $post->category_id = 2;
        $post->user_id = 1;
        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'Tag 2']));

        $post = new Post;
        $post->title = "Tercer Post";
        $post->url = str_slug("Tercer Post");
        $post->excerpt = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do";
        $post->body = "<p>Lorem ipsum dolor sit amet, consectetur adip</p>";
        $post->iframe = "";
        $post->published_at = Carbon::now()->format('Y-m-d H:i:s');
        $post->category_id = 2;
        $post->user_id = 1;
        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'Tag 3']));

        $post = new Post;
        $post->title = "Cuarto Post";
        $post->url = str_slug("Cuarto Post");
        $post->excerpt = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do";
        $post->body = "<p>Lorem ipsum dolor sit amet, consectetur adip</p>";
        $post->iframe = "";
        $post->published_at = Carbon::now()->format('Y-m-d H:i:s');
        $post->category_id = 1;
        $post->user_id = 2;
        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'Tag 4']));

        $post = new Post;
        $post->title = "Quinto Post";
        $post->url = str_slug("Quinto Post");
        $post->excerpt = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do";
        $post->body = "<p>Lorem ipsum dolor sit amet, consectetur adip</p>";
        $post->iframe = "";
        $post->published_at = Carbon::now()->format('Y-m-d H:i:s');
        $post->category_id = 1;
        $post->user_id = 2;
        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'Tag 5']));

        $role = Role::create(['name' => 'Admin', 'display_name' => 'Administrador']);

        $CPpermission = Permission::create(['name' => 'Create Posts', 'display_name' => 'Crear Posts']);
        $VPpermission = Permission::create(['name' => 'View Posts', 'display_name' => 'Ver Posts']);
        $UPpermission = Permission::create(['name' => 'Update Posts', 'display_name' => 'Actualizar Posts']);
        $DPpermission = Permission::create(['name' => 'Delete Posts', 'display_name' => 'Eliminar Posts']);

        $CUpermission = Permission::create(['name' => 'Create User', 'display_name' => 'Crear Usuarios']);
        $VUpermission = Permission::create(['name' => 'View User', 'display_name' => 'Ver Usuarios']);
        $UUpermission = Permission::create(['name' => 'Update User', 'display_name' => 'Actualizar Usuarios']);
        $DUpermission = Permission::create(['name' => 'Delete User', 'display_name' => 'Eliminar Usuarios']);

        $CRpermission = Permission::create(['name' => 'Create Roles', 'display_name' => 'Crear Roles']);
        $URpermission = Permission::create(['name' => 'Update Roles', 'display_name' => 'Ver Roles']);
        $VRpermission = Permission::create(['name' => 'View Roles', 'display_name' => 'Actualizar Roles']);
        $DRpermission = Permission::create(['name' => 'Delete Roles', 'display_name' => 'Eliminar Roles']);

        $CPEpermission = Permission::create(['name' => 'Create Permissions', 'display_name' => 'Crear Permisos']);
        $UPEpermission = Permission::create(['name' => 'Update Permissions', 'display_name' => 'Ver Permisos']);
        $VPEpermission = Permission::create(['name' => 'View Permissions', 'display_name' => 'Actualizar Permisos']);
        $DPEpermission = Permission::create(['name' => 'Delete Permissions', 'display_name' => 'Eliminar Permisos']);

        $role->givePermissionTo($CPpermission);
        $role->givePermissionTo($VPpermission);
        $role->givePermissionTo($UPpermission);
        $role->givePermissionTo($DPpermission);

        $role->givePermissionTo($CUpermission);
        $role->givePermissionTo($VUpermission);
        $role->givePermissionTo($UUpermission);
        $role->givePermissionTo($DUpermission);

        $role->givePermissionTo($CRpermission);
        $role->givePermissionTo($URpermission);
        $role->givePermissionTo($VRpermission);
        $role->givePermissionTo($DRpermission);

        $role->givePermissionTo($CPEpermission);
        $role->givePermissionTo($UPEpermission);
        $role->givePermissionTo($VPEpermission);
        $role->givePermissionTo($DPEpermission);


        $user = new User;
        $user->name = 'Uno';
        $user->email = 'uno@correo.com';
        $user->password = '123456';
        $user->save();
        $user->assignRole($role);

        $role = Role::create(['name' => 'Writer', 'display_name' => 'Escritor']);

        $role->givePermissionTo($CPpermission);
        $role->givePermissionTo($VPpermission);
        $role->givePermissionTo($UPpermission);
        $role->givePermissionTo($DPpermission);

        $user = new User;
        $user->name = 'John Doe';
        $user->email = 'john@doe.com';
        $user->password = '123456';
        $user->save();
        $user->assignRole($role);

        $role = Role::create(['name' => 'AA']);
        $role = Role::create(['name' => 'BB']);
        $role = Role::create(['name' => 'CC']);
        $role = Role::create(['name' => 'DD']);
    }
}