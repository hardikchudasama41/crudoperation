<?php
$rowscount = 5;
$lCount = $rCount = $k = 0;

for ($row = 1; $row <= $rowscount; $row++)
{
	for ($space = 1; $space <= $rowscount - $row; $space++)
	{
		print "&nbsp;&nbsp;";
		$lCount++;
	}
	while ($k != 2 * $row - 1)
	{
		if ($lCount <= $rowscount - 1)
		{
			echo ($row + $k);
			$lCount++;
		}
		else
		{
			$rCount++;
			echo ($row + $k) - 2 * $rCount;
		}
		$k++;
	}
	$lCount = $rCount = $k = 0;
	print "</br>";
}
