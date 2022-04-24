<?php require 'layout/header.php' ?>
<h1>Danh sách sinh viên đăng ký môn học</h1>
            <a href="?c=register&a=create" class="btn btn-info">Add</a>
            <form action="?c=register" method="GET">
                <label class="form-inline justify-content-end">Tìm kiếm: <input type="search" name="search" class="form-control" value="<?=$search?>">
                <button class="btn btn-danger">Tìm</button>
                </label>
                <input type="hidden" name="c" value="register">
            </form>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Mã SV</th>
                        <th>Tên SV</th>
                        <th>Mã MH</th>
                        <th>Tên MH</th>
                        <th>Điểm</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
					<?php 
					$stt = 0;
					foreach ( $registers as $register):
						$stt++;
					?>
                    <tr>
                        <td><?=$stt?></td>
                        <td><?=$register->student_id?></td>
                        <td><?=$register->student_name?></td>
                        <td><?=$register->subject_id?></td>
                        <td><?=$register->subject_name?></td>
                        <td><?=$register->score?></td>
                        <td><a href="?c=register&a=edit&id=<?=$register->id?>">Cập nhật điểm</a></td>
                        <td>
                <button data-url="?c=register&a=destroy&id=<?=$register->id?>" type="button" class="btn btn-danger btn-sm destroy"
                    data-toggle="modal" data-target="#exampleModal">
                    Xóa
                </button>
            </td>  
                </tbody>
				<?php endforeach ?>
            </table>
            <div>
                <span>Số lượng: <?=count($registers)?></span>
            </div>
<?php require 'layout/footer.php' ?>