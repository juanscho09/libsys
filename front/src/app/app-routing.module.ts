import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';
import { AuthComponent } from './auth/auth/auth.component';
import { PagesComponent } from './main/pages/pages.component';
import { authGuard } from './auth/auth.guard';

const routes: Routes = [
  { path:'', redirectTo:'/login', pathMatch:'full'},
  { path:'login', component: AuthComponent },
  { path:'dashboard', component: PagesComponent, canActivate: [authGuard],
    children: [
      { path: 'book',
        canActivate: [authGuard],
        loadChildren: () => import('./main/book/book.module').then(m => m.BookModule)
      },
      { path: 'user',
        canActivate: [authGuard],
        loadChildren: () => import('./main/user/user.module').then(m => m.UserModule)
      },
      { path: 'booking',
        canActivate: [authGuard],
        loadChildren: () => import('./main/booking/booking.module').then(m => m.BookingModule)
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })],
  exports: [RouterModule]
})
export class AppRoutingModule { }
