<?php
                $i = 0; $nbr = 4;
                $data = show_timeline($nbr, $page, $id);

                /* Control of Timeline loop */

                foreach ($data as $row) {
                    if ($row['privacy'] == 2 && $row['id_user'] == returnID()) {
                        $i = $i+1;
                        /****Show Post*******/
                        include 'includes/post.php';
                    } elseif ($row['privacy'] == 2 && $row['id_user'] != returnID()) {
                        /****Nothing to do*******/
                    } else {
                    
                    /***/
                        if ($page == 'timeline') {
                            $isFollow = select_doublearg('friends', 'id_sender', returnID(), 'id_recipient', $id, 'date_send');
                            if ($row['privacy'] == 1 && $isFollow == '' && $id != returnID()) {
                                /****Nothing to do*******/
                            } else {
                                $i = $i+1;
                                /****Show Post*******/
                                include 'includes/post.php';
                            }
                        } else {
                            $i = $i+1;
                            /****Show Post*******/
                            include 'includes/post.php';
                        }
                        /**/
                    }
                    $pid_row = $row['pid'];
                }

                /*** Display Ads ***/
                include 'includes/post-ads.php';
                 
                $post_count = post_count($style = false, $nbr, $page);
                if ($post_count == $nbr) {
                    if ($i < $nbr) {
                        $ni = 0;
                        $nbr = $nbr - $i;
                        while ($ni < $nbr) {
                            $data = show_timeline_loadmore($pid_row, '4', $page, $id);
                            $post_count = post_count($style = false, '1', $page);
                            if ($post_count > 0) {
                                $row = $data[0];
                                if ($row['privacy'] == 2 && $row['id_user'] == returnID()) {
                                    $ni = $ni+1;
                                    /****Show Post*******/
                                    include 'includes/post.php';
                                } elseif ($row['privacy'] == 2 && $row['id_user'] != returnID()) {
                                } else {
                                    if ($page == 'timeline') {
                                        $isFollow = select_doublearg('friends', 'id_sender', returnID(), 'id_recipient', $id, 'date_send');
                                        if ($row['privacy'] == 1 && $isFollow == '' && $id != returnID()) {
                                        } else {
                                            $ni = $ni+1;
                                            /****Show Post*******/
                                            include 'includes/post.php';
                                        }
                                    } else {
                                        $ni = $ni+1;
                                        /****Show Post*******/
                                        include 'includes/post.php';
                                    }
                                }
                                $pid_row = $row['pid'];
                            } else {
                                break;
                            }
                        }
                    }
                }
