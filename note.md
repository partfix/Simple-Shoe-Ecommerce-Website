# The developer of this project is dev@patfix All rights reserved 2025.

# This a simple ecommerce website that perfoms CRUD

moving \_\_dir path.

../ moves up one directory.
../../ moves up two directories.

# if you encounter problem in your php_session_start()

just put a... echo sys_get_temp_dir();
then find the your correct path... for example C:\Users\JOHNCL~1\AppData\Local\Temp
open..php.ini-> change the file path with session.save_path = "C:\Users\JOHNCL~1\AppData\Local\Temp" (with your correct file path)

# Query

insert -> mysli_query(param)
where -> mysqli_num_rows(param)

# session_id()

always change every new req
