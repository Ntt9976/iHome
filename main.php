							<?php
							include "connect.php";
							$sql = "SELECT srel,form,city,region,address,descb,price,phone FROM House;";
							$result =sqlsrv_query($conn,$sql);
							$info=sqlsrv_fetch_array($result);
							$username = $_SESSION['username'];
							if ($username == null)
							{
							
							sqlsrv_close($conn);
							header("Location:login.html" );
							}
							if($info==False){
								echo "無資料!";
							}
							else{
								do{
							?>
							<tr style="border: 5px solid #ffa500;">
								<td style="border: 5px solid #ffa500;"> <font size="5"><?php echo $info['srel'];?> </font></td>
								<td style="border: 5px solid #ffa500;"> <font size="5"><?php echo $info['form'];?></font> </td>
								<td style="border: 5px solid #ffa500;"> <font size="5"><?php echo $info['city'];?> </font></td>
								<td style="border: 5px solid #ffa500;"> <font size="5"><?php echo $info['region'];?> </font></td>
								<td style="border: 5px solid #ffa500;"> <font size="5"><?php echo $info['address'];?> </font></td>
								<td style="border: 5px solid #ffa500;"> <font size="5"><?php echo $info['descb'];?> </font></td>
								<td style="border: 5px solid #ffa500;"> <font size="5"><?php echo $info['price'];?> </font></td>
								<td style="border: 5px solid #ffa500;"> <font size="5"><?php echo $info['phone'];?> </font></td>
							</tr>
							<?php
							}
							while($info=sqlsrv_fetch_array($result));
							sqlsrv_close($conn);
							}
							?>
