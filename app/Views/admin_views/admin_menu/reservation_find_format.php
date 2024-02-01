<?php if (count($dataReservationTimeline) > 0) : ?>
    <?php for ($i = 0; $i < count($dataReservationTimeline) - 5; $i++) : ?>
        <div class="col-md-3 mb-4 text-center">
            <h4 class="m-0"><?php echo $dataReservationTimeline[$i]['nama_tipe'] ?> Room</h4>
        </div>
        <div class="col-md-9 mb-4 text-center">
            <div class="input-group">
                <button class="btn btn-outline-secondary" type="button" data-bs-action="<?= base_url('admin/find') ?>" id="prevMonth<?= $dataReservationTimeline[$i]['id_tipe_kamar'] ?>" data-bs-roomtype="<?= $dataReservationTimeline[$i]['id_tipe_kamar'] ?>" data-bs-find="0" onclick="findTlByMonth(this.id)">
                    <ion-icon name="caret-back-outline"></ion-icon>
                </button>
                <input type="text" class="form-control text-center fw-bolder text-primary" id="monthYear_<?= $dataReservationTimeline[$i]['id_tipe_kamar'] ?>" data-bs-monthyear="<?= $dataReservationTimeline['currentYear'] . '-' . (strlen($dataReservationTimeline['currentMonth']) > 1 ? $dataReservationTimeline['currentMonth'] : '0' . $dataReservationTimeline['currentMonth']) . '-01' ?>" value="<?= $dataReservationTimeline['monthYear'] ?>" disabled>
                <button class="btn btn-outline-secondary" type="button" data-bs-action="<?= base_url('admin/find') ?>" id="nextMonth<?= $dataReservationTimeline[$i]['id_tipe_kamar'] ?>" data-bs-roomtype="<?= $dataReservationTimeline[$i]['id_tipe_kamar'] ?>" data-bs-find="1" onclick="findTlByMonth(this.id)">
                    <ion-icon name="caret-forward-outline"></ion-icon>
                </button>
            </div>
        </div>
        <div class="col-md-3">
            <table class="table table-borderless">
                <tbody class="text-center">
                    <tr>
                        <th scope="col">Room #</th>
                    </tr>
                    <?php for ($j = 0; $j < count($dataReservationTimeline[$i]) - 2; $j++) : ?>
                        <?php if ($j == 0) : ?>
                            <tr>
                                <td class="fw-bolder text-primary-emphasis"><?php echo $dataReservationTimeline[$i][$j]["no_kamar"]; ?></td>
                            </tr>
                        <?php elseif ($j == 1) : ?>
                            <tr>
                                <td class="fw-bolder text-warning-emphasis"><?php echo $dataReservationTimeline[$i][$j]["no_kamar"]; ?></td>
                            </tr>
                        <?php else : ?>
                            <tr>
                                <td class="fw-bolder text-success"><?php echo $dataReservationTimeline[$i][$j]["no_kamar"]; ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-9">

            <?php if ($dataReservationTimeline[$i]['nama_tipe'] == "Baginda Raja") : ?>
                <div id="baginda-reservation-tl" class="reservation-tl">
                    <table class="table baginda-table-tl">
                        <tbody class="text-center">
                            <tr>
                                <?php for ($k = 0; $k < $dataReservationTimeline["daysInCurrentMonth"]; $k++) : ?>
                                    <th scope="col" class="tgl tgl-<?= $k + 1 ?>">
                                        <?php if ($k + 1 < 10) {
                                            echo '0' . $k + 1;
                                        } else {
                                            echo $k + 1;
                                        } ?>
                                    </th>
                                <?php endfor; ?>
                            </tr>
                            <?php for ($j = 0; $j < count($dataReservationTimeline[$i]) - 2; $j++) : ?>
                                <?php if ($j == 0 && array_key_exists("reserved_room", $dataReservationTimeline[$i][$j])) : ?>
                                    <tr height="39px">
                                        <?php
                                        $totalPrevColspan = 0;
                                        $prevEndDay = 0;
                                        ?>
                                        <?php for ($k = 0; $k < count($dataReservationTimeline[$i][$j]["reserved_room"]); $k++) : ?>

                                            <?php $kode_reservasi =  $dataReservationTimeline[$i][$j]['reserved_room'][$k]["kode_reservasi"]; ?>

                                            <?php if ($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] == 1) : ?>
                                                <?php
                                                $totalPrevColspan += $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1;
                                                $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                ?>
                                                <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1; ?>" class="bg-primary rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                            <?php elseif ($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] > 1) : ?>
                                                <?php if (!($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] == $prevEndDay)) : ?>
                                                    <?php
                                                    $emptyColspan = $dataReservationTimeline["daysInCurrentMonth"] - ($dataReservationTimeline["daysInCurrentMonth"] - $dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"]) - 1;
                                                    ?>

                                                    <?php if ($emptyColspan - $totalPrevColspan > 0) : ?>
                                                        <td colspan="<?= $emptyColspan - $totalPrevColspan; ?>"></td>
                                                    <?php endif; ?>

                                                    <?php
                                                    $totalPrevColspan += (($emptyColspan - $totalPrevColspan) + $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1);
                                                    $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                    ?>
                                                    <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1; ?>" class="bg-primary rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                                <?php else : ?>
                                                    <?php
                                                    $totalPrevColspan += $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'];
                                                    $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                    ?>
                                                    <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap']; ?>" class="bg-primary rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <?php if ($totalPrevColspan < $dataReservationTimeline["daysInCurrentMonth"]) : ?>
                                            <td colspan="<?= $dataReservationTimeline["daysInCurrentMonth"] - $totalPrevColspan ?>"></td>
                                        <?php endif ?>
                                    </tr>
                                <?php elseif ($j == 0 && !array_key_exists("reserved_room", $dataReservationTimeline[$i][$j])) : ?>
                                    <tr height="39px">
                                        <td colspan="<?= $dataReservationTimeline["daysInCurrentMonth"] ?>"></td>
                                    </tr>
                                <?php endif; ?>



                                <?php if ($j == 1 && array_key_exists("reserved_room", $dataReservationTimeline[$i][$j])) : ?>
                                    <tr height="39px">
                                        <?php
                                        $totalPrevColspan = 0;
                                        $prevEndDay = 0;
                                        ?>
                                        <?php for ($k = 0; $k < count($dataReservationTimeline[$i][$j]["reserved_room"]); $k++) : ?>

                                            <?php $kode_reservasi =  $dataReservationTimeline[$i][$j]['reserved_room'][$k]["kode_reservasi"]; ?>

                                            <?php if ($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] == 1) : ?>
                                                <?php
                                                $totalPrevColspan += $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1;
                                                $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                ?>
                                                <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1; ?>" class="bg-warning rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                            <?php elseif ($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] > 1) : ?>
                                                <?php if (!($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] == $prevEndDay)) : ?>
                                                    <?php
                                                    $emptyColspan = $dataReservationTimeline["daysInCurrentMonth"] - ($dataReservationTimeline["daysInCurrentMonth"] - $dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"]) - 1;
                                                    ?>

                                                    <?php if ($emptyColspan - $totalPrevColspan > 0) : ?>
                                                        <td colspan="<?= $emptyColspan - $totalPrevColspan; ?>"></td>
                                                    <?php endif; ?>

                                                    <?php
                                                    $totalPrevColspan += (($emptyColspan - $totalPrevColspan) + $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1);
                                                    $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                    ?>
                                                    <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1; ?>" class="bg-warning rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                                <?php else : ?>
                                                    <?php
                                                    $totalPrevColspan += $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'];
                                                    $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                    ?>
                                                    <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap']; ?>" class="bg-warning rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <?php if ($totalPrevColspan < $dataReservationTimeline["daysInCurrentMonth"]) : ?>
                                            <td colspan="<?= $dataReservationTimeline["daysInCurrentMonth"] - $totalPrevColspan ?>"></td>
                                        <?php endif ?>
                                    </tr>
                                <?php elseif ($j == 1 && !array_key_exists("reserved_room", $dataReservationTimeline[$i][$j])) : ?>
                                    <tr height="39px">
                                        <td colspan="<?= $dataReservationTimeline["daysInCurrentMonth"] ?>"></td>
                                    </tr>
                                <?php endif; ?>



                                <?php if ($j == 2 && array_key_exists("reserved_room", $dataReservationTimeline[$i][$j])) : ?>
                                    <tr height="39px">
                                        <?php
                                        $totalPrevColspan = 0;
                                        $prevEndDay = 0;
                                        ?>
                                        <?php for ($k = 0; $k < count($dataReservationTimeline[$i][$j]["reserved_room"]); $k++) : ?>

                                            <?php $kode_reservasi =  $dataReservationTimeline[$i][$j]['reserved_room'][$k]["kode_reservasi"]; ?>

                                            <?php if ($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] == 1) : ?>
                                                <?php
                                                $totalPrevColspan += $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1;
                                                $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                ?>
                                                <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1; ?>" class="bg-success rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                            <?php elseif ($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] > 1) : ?>
                                                <?php if (!($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] == $prevEndDay)) : ?>
                                                    <?php
                                                    $emptyColspan = $dataReservationTimeline["daysInCurrentMonth"] - ($dataReservationTimeline["daysInCurrentMonth"] - $dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"]) - 1;
                                                    ?>

                                                    <?php if ($emptyColspan - $totalPrevColspan > 0) : ?>
                                                        <td colspan="<?= $emptyColspan - $totalPrevColspan; ?>"></td>
                                                    <?php endif; ?>

                                                    <?php
                                                    $totalPrevColspan += (($emptyColspan - $totalPrevColspan) + $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1);
                                                    $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                    ?>
                                                    <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1; ?>" class="bg-success rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                                <?php else : ?>
                                                    <?php
                                                    $totalPrevColspan += $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'];
                                                    $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                    ?>
                                                    <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap']; ?>" class="bg-success rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <?php if ($totalPrevColspan < $dataReservationTimeline["daysInCurrentMonth"]) : ?>
                                            <td colspan="<?= $dataReservationTimeline["daysInCurrentMonth"] - $totalPrevColspan ?>"></td>
                                        <?php endif ?>
                                    </tr>
                                <?php elseif ($j == 2 && !array_key_exists("reserved_room", $dataReservationTimeline[$i][$j])) : ?>
                                    <tr height="39px">
                                        <td colspan="<?= $dataReservationTimeline["daysInCurrentMonth"] ?>"></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>




            <?php elseif ($dataReservationTimeline[$i]['nama_tipe'] == "Panglima") : ?>
                <div id="panglima-reservation-tl" class="reservation-tl">
                    <table class="table panglima-table-tl">
                        <tbody class="text-center">
                            <tr>
                                <?php for ($k = 0; $k < $dataReservationTimeline["daysInCurrentMonth"]; $k++) : ?>
                                    <th scope="col" class="tgl tgl-<?= $k + 1 ?>">
                                        <?php if ($k + 1 < 10) {
                                            echo '0' . $k + 1;
                                        } else {
                                            echo $k + 1;
                                        } ?>
                                    </th>
                                <?php endfor; ?>
                            </tr>
                            <?php for ($j = 0; $j < count($dataReservationTimeline[$i]) - 2; $j++) : ?>
                                <?php if ($j == 0 && array_key_exists("reserved_room", $dataReservationTimeline[$i][$j])) : ?>
                                    <tr height="39px">
                                        <?php
                                        $totalPrevColspan = 0;
                                        $prevEndDay = 0;
                                        ?>
                                        <?php for ($k = 0; $k < count($dataReservationTimeline[$i][$j]["reserved_room"]); $k++) : ?>

                                            <?php $kode_reservasi =  $dataReservationTimeline[$i][$j]['reserved_room'][$k]["kode_reservasi"]; ?>

                                            <?php if ($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] == 1) : ?>
                                                <?php
                                                $totalPrevColspan += $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1;
                                                $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                ?>
                                                <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1; ?>" class="bg-primary rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                            <?php elseif ($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] > 1) : ?>
                                                <?php if (!($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] == $prevEndDay)) : ?>
                                                    <?php
                                                    $emptyColspan = $dataReservationTimeline["daysInCurrentMonth"] - ($dataReservationTimeline["daysInCurrentMonth"] - $dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"]) - 1;
                                                    ?>

                                                    <?php if ($emptyColspan - $totalPrevColspan > 0) : ?>
                                                        <td colspan="<?= $emptyColspan - $totalPrevColspan; ?>"></td>
                                                    <?php endif; ?>

                                                    <?php
                                                    $totalPrevColspan += (($emptyColspan - $totalPrevColspan) + $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1);
                                                    $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                    ?>
                                                    <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1; ?>" class="bg-primary rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                                <?php else : ?>
                                                    <?php
                                                    $totalPrevColspan += $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'];
                                                    $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                    ?>
                                                    <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap']; ?>" class="bg-primary rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <?php if ($totalPrevColspan < $dataReservationTimeline["daysInCurrentMonth"]) : ?>
                                            <td colspan="<?= $dataReservationTimeline["daysInCurrentMonth"] - $totalPrevColspan ?>"></td>
                                        <?php endif ?>
                                    </tr>
                                <?php elseif ($j == 0 && !array_key_exists("reserved_room", $dataReservationTimeline[$i][$j])) : ?>
                                    <tr height="39px">
                                        <td colspan="<?= $dataReservationTimeline["daysInCurrentMonth"] ?>"></td>
                                    </tr>
                                <?php endif; ?>



                                <?php if ($j == 1 && array_key_exists("reserved_room", $dataReservationTimeline[$i][$j])) : ?>
                                    <tr height="39px">
                                        <?php
                                        $totalPrevColspan = 0;
                                        $prevEndDay = 0;
                                        ?>
                                        <?php for ($k = 0; $k < count($dataReservationTimeline[$i][$j]["reserved_room"]); $k++) : ?>

                                            <?php $kode_reservasi =  $dataReservationTimeline[$i][$j]['reserved_room'][$k]["kode_reservasi"]; ?>

                                            <?php if ($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] == 1) : ?>
                                                <?php
                                                $totalPrevColspan += $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1;
                                                $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                ?>
                                                <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1; ?>" class="bg-warning rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                            <?php elseif ($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] > 1) : ?>
                                                <?php if (!($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] == $prevEndDay)) : ?>
                                                    <?php
                                                    $emptyColspan = $dataReservationTimeline["daysInCurrentMonth"] - ($dataReservationTimeline["daysInCurrentMonth"] - $dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"]) - 1;
                                                    ?>

                                                    <?php if ($emptyColspan - $totalPrevColspan > 0) : ?>
                                                        <td colspan="<?= $emptyColspan - $totalPrevColspan; ?>"></td>
                                                    <?php endif; ?>

                                                    <?php
                                                    $totalPrevColspan += (($emptyColspan - $totalPrevColspan) + $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1);
                                                    $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                    ?>
                                                    <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1; ?>" class="bg-warning rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                                <?php else : ?>
                                                    <?php
                                                    $totalPrevColspan += $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'];
                                                    $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                    ?>
                                                    <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap']; ?>" class="bg-warning rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <?php if ($totalPrevColspan < $dataReservationTimeline["daysInCurrentMonth"]) : ?>
                                            <td colspan="<?= $dataReservationTimeline["daysInCurrentMonth"] - $totalPrevColspan ?>"></td>
                                        <?php endif ?>
                                    </tr>
                                <?php elseif ($j == 1 && !array_key_exists("reserved_room", $dataReservationTimeline[$i][$j])) : ?>
                                    <tr height="39px">
                                        <td colspan="<?= $dataReservationTimeline["daysInCurrentMonth"] ?>"></td>
                                    </tr>
                                <?php endif; ?>



                                <?php if ($j == 2 && array_key_exists("reserved_room", $dataReservationTimeline[$i][$j])) : ?>
                                    <tr height="39px">
                                        <?php
                                        $totalPrevColspan = 0;
                                        $prevEndDay = 0;
                                        ?>
                                        <?php for ($k = 0; $k < count($dataReservationTimeline[$i][$j]["reserved_room"]); $k++) : ?>

                                            <?php $kode_reservasi =  $dataReservationTimeline[$i][$j]['reserved_room'][$k]["kode_reservasi"]; ?>

                                            <?php if ($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] == 1) : ?>
                                                <?php
                                                $totalPrevColspan += $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1;
                                                $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                ?>
                                                <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1; ?>" class="bg-success rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                            <?php elseif ($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] > 1) : ?>
                                                <?php if (!($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] == $prevEndDay)) : ?>
                                                    <?php
                                                    $emptyColspan = $dataReservationTimeline["daysInCurrentMonth"] - ($dataReservationTimeline["daysInCurrentMonth"] - $dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"]) - 1;
                                                    ?>

                                                    <?php if ($emptyColspan - $totalPrevColspan > 0) : ?>
                                                        <td colspan="<?= $emptyColspan - $totalPrevColspan; ?>"></td>
                                                    <?php endif; ?>

                                                    <?php
                                                    $totalPrevColspan += (($emptyColspan - $totalPrevColspan) + $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1);
                                                    $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                    ?>
                                                    <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1; ?>" class="bg-success rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                                <?php else : ?>
                                                    <?php
                                                    $totalPrevColspan += $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'];
                                                    $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                    ?>
                                                    <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap']; ?>" class="bg-success rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <?php if ($totalPrevColspan < $dataReservationTimeline["daysInCurrentMonth"]) : ?>
                                            <td colspan="<?= $dataReservationTimeline["daysInCurrentMonth"] - $totalPrevColspan ?>"></td>
                                        <?php endif ?>
                                    </tr>
                                <?php elseif ($j == 2 && !array_key_exists("reserved_room", $dataReservationTimeline[$i][$j])) : ?>
                                    <tr height="39px">
                                        <td colspan="<?= $dataReservationTimeline["daysInCurrentMonth"] ?>"></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>





            <?php elseif ($dataReservationTimeline[$i]['nama_tipe'] == "Prajurit") : ?>
                <div id="prajurit-reservation-tl" class="reservation-tl">
                    <table class="table prajurit-table-tl">
                        <tbody class="text-center">
                            <tr>
                                <?php for ($k = 0; $k < $dataReservationTimeline["daysInCurrentMonth"]; $k++) : ?>
                                    <th scope="col" class="tgl tgl-<?= $k + 1 ?>">
                                        <?php if ($k + 1 < 10) {
                                            echo '0' . $k + 1;
                                        } else {
                                            echo $k + 1;
                                        } ?>
                                    </th>
                                <?php endfor; ?>
                            </tr>
                            <?php for ($j = 0; $j < count($dataReservationTimeline[$i]) - 2; $j++) : ?>
                                <?php if ($j == 0 && array_key_exists("reserved_room", $dataReservationTimeline[$i][$j])) : ?>
                                    <tr height="39px">
                                        <?php
                                        $totalPrevColspan = 0;
                                        $prevEndDay = 0;
                                        ?>
                                        <?php for ($k = 0; $k < count($dataReservationTimeline[$i][$j]["reserved_room"]); $k++) : ?>

                                            <?php $kode_reservasi =  $dataReservationTimeline[$i][$j]['reserved_room'][$k]["kode_reservasi"]; ?>

                                            <?php if ($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] == 1) : ?>
                                                <?php
                                                $totalPrevColspan += $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1;
                                                $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                ?>
                                                <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1; ?>" class="bg-primary rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                            <?php elseif ($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] > 1) : ?>
                                                <?php if (!($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] == $prevEndDay)) : ?>
                                                    <?php
                                                    $emptyColspan = $dataReservationTimeline["daysInCurrentMonth"] - ($dataReservationTimeline["daysInCurrentMonth"] - $dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"]) - 1;
                                                    ?>

                                                    <?php if ($emptyColspan - $totalPrevColspan > 0) : ?>
                                                        <td colspan="<?= $emptyColspan - $totalPrevColspan; ?>"></td>
                                                    <?php endif; ?>

                                                    <?php
                                                    $totalPrevColspan += (($emptyColspan - $totalPrevColspan) + $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1);
                                                    $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                    ?>
                                                    <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1; ?>" class="bg-primary rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                                <?php else : ?>
                                                    <?php
                                                    $totalPrevColspan += $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'];
                                                    $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                    ?>
                                                    <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap']; ?>" class="bg-primary rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <?php if ($totalPrevColspan < $dataReservationTimeline["daysInCurrentMonth"]) : ?>
                                            <td colspan="<?= $dataReservationTimeline["daysInCurrentMonth"] - $totalPrevColspan ?>"></td>
                                        <?php endif ?>
                                    </tr>
                                <?php elseif ($j == 0 && !array_key_exists("reserved_room", $dataReservationTimeline[$i][$j])) : ?>
                                    <tr height="39px">
                                        <td colspan="<?= $dataReservationTimeline["daysInCurrentMonth"] ?>"></td>
                                    </tr>
                                <?php endif; ?>



                                <?php if ($j == 1 && array_key_exists("reserved_room", $dataReservationTimeline[$i][$j])) : ?>
                                    <tr height="39px">
                                        <?php
                                        $totalPrevColspan = 0;
                                        $prevEndDay = 0;
                                        ?>
                                        <?php for ($k = 0; $k < count($dataReservationTimeline[$i][$j]["reserved_room"]); $k++) : ?>

                                            <?php $kode_reservasi =  $dataReservationTimeline[$i][$j]['reserved_room'][$k]["kode_reservasi"]; ?>

                                            <?php if ($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] == 1) : ?>
                                                <?php
                                                $totalPrevColspan += $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1;
                                                $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                ?>
                                                <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1; ?>" class="bg-warning rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                            <?php elseif ($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] > 1) : ?>
                                                <?php if (!($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] == $prevEndDay)) : ?>
                                                    <?php
                                                    $emptyColspan = $dataReservationTimeline["daysInCurrentMonth"] - ($dataReservationTimeline["daysInCurrentMonth"] - $dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"]) - 1;
                                                    ?>

                                                    <?php if ($emptyColspan - $totalPrevColspan > 0) : ?>
                                                        <td colspan="<?= $emptyColspan - $totalPrevColspan; ?>"></td>
                                                    <?php endif; ?>

                                                    <?php
                                                    $totalPrevColspan += (($emptyColspan - $totalPrevColspan) + $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1);
                                                    $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                    ?>
                                                    <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1; ?>" class="bg-warning rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                                <?php else : ?>
                                                    <?php
                                                    $totalPrevColspan += $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'];
                                                    $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                    ?>
                                                    <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap']; ?>" class="bg-warning rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <?php if ($totalPrevColspan < $dataReservationTimeline["daysInCurrentMonth"]) : ?>
                                            <td colspan="<?= $dataReservationTimeline["daysInCurrentMonth"] - $totalPrevColspan ?>"></td>
                                        <?php endif ?>
                                    </tr>
                                <?php elseif ($j == 1 && !array_key_exists("reserved_room", $dataReservationTimeline[$i][$j])) : ?>
                                    <tr height="39px">
                                        <td colspan="<?= $dataReservationTimeline["daysInCurrentMonth"] ?>"></td>
                                    </tr>
                                <?php endif; ?>



                                <?php if ($j == 2 && array_key_exists("reserved_room", $dataReservationTimeline[$i][$j])) : ?>
                                    <tr height="39px">
                                        <?php
                                        $totalPrevColspan = 0;
                                        $prevEndDay = 0;
                                        ?>
                                        <?php for ($k = 0; $k < count($dataReservationTimeline[$i][$j]["reserved_room"]); $k++) : ?>

                                            <?php $kode_reservasi =  $dataReservationTimeline[$i][$j]['reserved_room'][$k]["kode_reservasi"]; ?>

                                            <?php if ($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] == 1) : ?>
                                                <?php
                                                $totalPrevColspan += $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1;
                                                $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                ?>
                                                <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1; ?>" class="bg-success rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                            <?php elseif ($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] > 1) : ?>
                                                <?php if (!($dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"] == $prevEndDay)) : ?>
                                                    <?php
                                                    $emptyColspan = $dataReservationTimeline["daysInCurrentMonth"] - ($dataReservationTimeline["daysInCurrentMonth"] - $dataReservationTimeline[$i][$j]["reserved_room"][$k]["start_day"]) - 1;
                                                    ?>

                                                    <?php if ($emptyColspan - $totalPrevColspan > 0) : ?>
                                                        <td colspan="<?= $emptyColspan - $totalPrevColspan; ?>"></td>
                                                    <?php endif; ?>

                                                    <?php
                                                    $totalPrevColspan += (($emptyColspan - $totalPrevColspan) + $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1);
                                                    $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                    ?>
                                                    <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'] + 1; ?>" class="bg-success rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                                <?php else : ?>
                                                    <?php
                                                    $totalPrevColspan += $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap'];
                                                    $prevEndDay = $dataReservationTimeline[$i][$j]["reserved_room"][$k]["end_day"];
                                                    ?>
                                                    <td colspan="<?= $dataReservationTimeline[$i][$j]['reserved_room'][$k]['durasi_inap']; ?>" class="bg-success rounded-4" data-bs-toggle="tooltip" data-bs-title="<?= $kode_reservasi ?>"></td>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <?php if ($totalPrevColspan < $dataReservationTimeline["daysInCurrentMonth"]) : ?>
                                            <td colspan="<?= $dataReservationTimeline["daysInCurrentMonth"] - $totalPrevColspan ?>"></td>
                                        <?php endif ?>
                                    </tr>
                                <?php elseif ($j == 2 && !array_key_exists("reserved_room", $dataReservationTimeline[$i][$j])) : ?>
                                    <tr height="39px">
                                        <td colspan="<?= $dataReservationTimeline["daysInCurrentMonth"] ?>"></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>


            <?php endif; ?>
        </div>
    <?php endfor; ?>
<?php endif; ?>