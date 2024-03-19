import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {BookCreateComponent } from './book-create/book-create.component';
import {BookEditComponent } from './book-edit/book-edit.component';
import {BookListComponent } from './book-list/book-list.component';


const routes: Routes = [
  { path:'books', component:BookListComponent },
  { path:'bookCreate', component:BookCreateComponent },
  { path:'bookEdit/:id', component:BookEditComponent }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class BookRoutingModule { }
