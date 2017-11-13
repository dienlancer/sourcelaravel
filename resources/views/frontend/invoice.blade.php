<table>


                        <!-- HEADER TABLE -->


                        <thead>


                            <tr align="center">


                              


                                <th>STT</th>


                                <th>ID</th>
                                <th>Code</th>
                                <th>Username</th>
                                <th>Tên</th>                                


                                          


                                <th>Trạng thái</th>



                            </tr>


                        </thead>


                       

                        <?php 


                        if(!empty($arrInvoice)){


                            ?>


                                <tbody>


                            <?php 


                            $stt=0; 


                            foreach ($arrInvoice as $key => $item) {


                                $stt++;


                                $id=$item["id"];

                                $code=$item["code"];
                                $username=$item["username"];
                                $name=$item["name"];                                                               


                                $trangThai=0;


                                if((int)$item["status"]==1)


                                    $trangThai=1;



                                $status     = $trangThai;



                                ?>


                                <tr class="odd" >

                                


                                <td align="center"><?php echo $stt; ?></td>


                                <td><?php echo $id; ?></td>

                                <td><?php echo $code; ?></td>
                                <td><?php echo $username; ?></td>
                                <td><?php echo $name; ?></td>



                                <td align="center">                                


                                    <?php echo $status; ?>


                                </td>



                            </tr>     


                                <?php


                            }


                            ?>                                    


                        </tbody>


                            <?php


                        }


                        ?>                        


                    </table>