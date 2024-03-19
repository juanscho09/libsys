import { Component, OnInit, ViewChild } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { User } from 'src/app/models/user/user.model';
import { UserService } from 'src/app/providers/user/user.service';
import { UserCreateComponent } from '../user-create/user-create.component';
import { ModalsComponent } from '../../modals/modals.component';
import { MatSnackBar, MatSnackBarHorizontalPosition, MatSnackBarVerticalPosition } from '@angular/material/snack-bar';

@Component({
  selector: 'app-user-list',
  templateUrl: './user-list.component.html',
  styleUrls: ['./user-list.component.scss']
})
export class UserListComponent implements OnInit {

  displayedColumns = ['id', 'name', 'lastname', 'email', 'actions'];
  dataSource = new MatTableDataSource<User>();
  users: User[] = [];
  totalCount: number = 0;
  pageIndex: number = 0;
  pageSize: number = 5;
  horizontalPosition: MatSnackBarHorizontalPosition = 'center';
  verticalPosition: MatSnackBarVerticalPosition = 'top';
  durationInSeconds = 5;
  isLoading = false;

  @ViewChild(MatPaginator) 
  paginator!: MatPaginator;
  @ViewChild(MatSort) 
  sort!: MatSort;

  constructor(
    private userService:UserService,
    private _dialog: MatDialog,
    private _snackBar: MatSnackBar
  ) {

  }

  ngOnInit(): void {
    //throw new Error('Method not implemented.');
    this.get("", "", "");
  }

  applyFilter(event: Event) {
    const filterValue = (event.target as HTMLInputElement).value;
    this.dataSource.filter = filterValue.trim().toLowerCase();

    if (this.dataSource.paginator) {
      this.dataSource.paginator.firstPage();
    }
  }

  handlePageEvent(e: PageEvent){
    this.pageIndex = e.pageIndex;
    this.pageSize = e.pageSize;

    this.get("", "", "");
  }

  get(sort: string, orderby: string, search: string){
    this.userService.getUsers(sort, orderby, search, (this.pageIndex + 1), this.pageSize).subscribe((response:any) => {
      this.users = response.body.message.data as User[];
      this.dataSource.data = response.body.message.data;
      this.totalCount = response.body.message.pagination.totalRows 
        ? Number(response.body.message.pagination.totalRows) 
        : 0;
    })
  }

  openAddUserForm(){
    const dialogRef = this._dialog.open(UserCreateComponent);
    dialogRef.afterClosed().subscribe(result => {
      if (result) {
        this.get("", "", "");
      }
    });
  }

  openEditUserForm(data: any){
    const dialogRef = this._dialog.open(UserCreateComponent, {
      data,
    });
    dialogRef.afterClosed().subscribe(result => {
      if (result) {
        this.get("", "", "");
      }
    });
  }

  openConfirmDialog(id: string): void {
    const dialogRef = this._dialog.open(ModalsComponent, {
      width: '350px',
      data: { message: '¿Estás seguro de que queres eliminar este elemento?' }
    });

    this.isLoading = true;
    dialogRef.afterClosed().subscribe(result => {
      if (result) {
        this.userService.deleteUser(id).subscribe(
          (resp: any) => {
            this.isLoading = false;
            this.openSnackBar();
            this.get("", "", "");
          },
          (err: any) => {
            this.isLoading = false;
          });
        // Aquí se ejecuta la lógica para eliminar el elemento
        // Llamada a tu función de eliminación
      } else { this.isLoading = false; }
    });
  }

  openSnackBar(){
    this._snackBar.open('Se eliminó correctamente!!', 'OK', {
      horizontalPosition: this.horizontalPosition,
      verticalPosition: this.verticalPosition,
      duration: this.durationInSeconds * 3000,
    });
  }

  openEditForm(data: any) {

  }

}
