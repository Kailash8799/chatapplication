<?php
include "comp/config.php";
$id=$_POST['id'];
$myid=$_POST['key'];

                                    $sql="SELECT * FROM chat WHERE (to_id=$id AND from_id=$myid) OR (to_id=$myid AND from_id=$id) ";
                                    $result=$link->query($sql);

                                    while($row2=$result->fetch_assoc()){
                                
                                if($row2['from_id']==$myid){
                                echo '<div class="media w-50 ml-auto mb-3">
                                <div class="media-body">
                                    <div class="bg-primary rounded py-2 px-3 mb-2">
                                        <p class="text-small mb-0 text-white">'.$row2['message'].'
                                        </p>
                                    </div>
                                    <p class="small text-muted">'.$row2['time'].'</p>
                                </div>
                            </div>';
                                }else{
                                echo '<div class="media w-50 mb-3"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg"
                                alt="user" width="50" class="rounded-circle">
                            <div class="media-body ml-3">
                                <div class="bg-light rounded py-2 px-3 mb-2">
                                    <p class="text-small mb-0 text-muted">'.$row2['message'].'</p>
                                </div>
                                <p class="small text-muted">'.$row2['time'].'</p>
                            </div>
                        </div>';
                                }
                            }
                                ?>