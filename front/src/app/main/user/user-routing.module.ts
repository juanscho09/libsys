import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {UserCreateComponent } from './user-create/user-create.component';
import {UserEditComponent } from './user-edit/user-edit.component';
import {UserListComponent } from './user-list/user-list.component';


const routes: Routes = [
  { path:'users', component:UserListComponent },
  { path:'userCreate', component:UserCreateComponent },
  { path:'userEdit/:id', component:UserEditComponent }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class UserRoutingModule { }
