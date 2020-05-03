<!DOCTYPE html>
<html>
    <head>
        <style>
            table, th, td {
                border: 1px solid black;
            }
            div {
                float: left;
                padding: 5px;
            }
        </style>
        <script>
            function submitUpdate(e){
                var form = document.forms["updateForm"];
                if(form["name"].value == "" && form["picture"].value == "")
                    e.preventDefault();
            }

            function submitDelete(e){
                if(!confirm('Are you sure?'))
                    e.preventDefault();
            }
        </script>
    </head>
    <body>
        <div>
            <table>
                <tr>
                    <th>ArtistID</th>
                    <th>Name</th>
                    <th>Picture</th>
                </tr>
                <?php
                    foreach ($allArtists as $row){
                        $tr = '<tr>';
                        $tr .= '<td>'.$row['ArtistID'].'</td>';
                        $tr .= '<td>'.$row['Name'].'</td>';
                        $tr .= '<td><img src="..'.$row['PictureAddress'].'" alt="'.$row['PictureAddress'].'" height=60 width=60/></td>';
                        $tr .= '</tr>';
                        echo $tr;
                    }
                ?>
            </table>
        </div>
        <div>
            <h2>Create new artist</h2>
            <form role="form" name="create" action="../index.php/artist/new" method="POST" enctype="multipart/form-data">
                <p>
                    <label>Name</label>
                    <input type="text" name="name" id="name" required/>
                </p>
                <p>
                    <label>Picture</label>
                    <input type="file" name="picture" id="picture" required/>
                </p>
                <p>
                    <input type="submit" name="confirm" class="button" value="Create"/>
                </p>
            </form>
            <h2>Update artist</h2>
            <form role="form" name="update" action="../index.php/artist/update" method="POST" enctype="multipart/form-data" onsubmit="submitUpdate(event)">
                <p>
                    <label>ArtistID</label>
                    <input type="number" min="0" step="1" name="artistID" id="artistID" required/>
                </p>
                <p>
                    <label>Name</label>
                    <input type="text" name="name" id="name"/>
                </p>
                <p>
                    <label>Picture</label>
                    <input type="file" name="picture" id="picture"/>
                </p>
                <p>
                    <input type="submit" name="confirm" class="button" value="Update"/>
                </p>
            </form>
            <h2>Delete artist</h2>
            <form role="form" name="delete" action="../index.php/artist/delete" method="POST" onsubmit="submitDelete(event)">
                <p>
                    <label>ArtistID</label>
                    <input type="number" min="0" step="1" name="artistID" id="artistID" required/>
                </p>
                <p>
                    <input type="submit" name="confirm" class="button" value="Delete"/>
                </p>
            </form>
            <a href="../index.php/login/logout">Logout</a>
        </div>        
</body>