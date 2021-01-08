<!DOCTYPE html>

<html lang="en">

    <head>
    	<title>Curtis Thompson - Decision Maths: Sorting</title>
    	<link rel="stylesheet" type="text/css" href="/stylesheets/main.css" />
    	<link rel="stylesheet" type="text/css" href="/stylesheets/notes.css" />
    	<meta name="author" content="Curtis Thompson" />
    	<meta name="description" content="Bubble Sort is one of the two sorting algorithms in D1, along with Quick Sort. It is a simple but inefficient way of sorting a list, and is not usually used in real life. The algorithm for the Bubble Sort is..." />
    	<meta name="keywords" content="curtis, thompson, bubble sort, quick sort, decision, maths, edexcel, d1, sorting, searching, education, notes" />
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/core-header.php'); ?>
    </head>
    
    
    <body>
    	<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/menu.php'); ?>
	
		<div id="main-content">
    		<h1 id="small-header-box">Decision Maths: Sorting</h1>
    		<div class="notes-text">
        		<div class="notes-details"><span class="author">Curtis Thompson</span><span class="date">Wednesday 6th April 2016</span><span class="topic">Academics</span></div>
    		
        		<p>Bubble Sort is one of the two sorting algorithms in D1, along with Quick Sort. It is a simple but inefficient way of sorting a list, and is not usually used in real life. The algorithm for the Bubble Sort is:</p>
        		<ol>
        			<li>Start at the beginning of the list, and go through comparing adjacent values</li>
        			<li>Swap the position of adjacent values if they are not in order</li>
        			<li>When the end of the list is reached, one pass is complete</li>
        			<ul>
        				<li>If there have been swaps, repeat step 1</li>
        				<li>If there have not been swaps, the list is ordered</li>
        			</ul>
        		</ol>
        		<p>The main points to remember about Bubble Sort are:</p>
        		<ul>
        			<li>Sorts an unsorted list</li>
        			<li>Not as efficient as Quick Sort</li>
        			<li>At most, n-1 passes where n is the number of items in the list</li>
        			<li>In an exam show the list at the end of each pass</li>
        		</ul>
        		<p>An example of Bubble Sort is shown below. It starts with the original list; 8, 3, 5, 9, 2, 4, 1, 7, 6</p>

        		<div class="captioned-image">
        			<img alt="Bubble sort" src="BubbleSortExample.png">
        			<p>The example above shows how a question should be answered when it asks for the Bubble Sort algorithm to be used.</p>
        		</div>
        		
        		<p>Quick Sort is the second of two sorting algorithms in D1, the other being Bubble Sort. Quick Sort is a quicker and more efficient algorithm than Bubble Sort so would be preferred in real life. However it is also more complicated. The algorithm for Quick Sort is:</p>
        		<ol>
        			<li>Select the midpoint of the list as the pivot</li>
        			<li>Before the pivot write each item that is meant to come before the pivot, but keeping the original order (this is one sublist)</li>
        			<li>After the pivot write each item that is meant to come after the pivot, but keeping the original order (this is one sublist)</li>
        			<li>Repeat step 1 with each sublist, until all items have been used as pivots</li>
        		</ol>
        		<p>The main points to remember about Quick Sort are:</p>
        		<ul>
        			<li>It is quicker and more efficient than Bubble Sort</li>
        			<li>At most, log(n) passes are needed (with logarithms in base 2)</li>
        			<li>In the exam show which items have been used as pivots by circling or boxing them</li>
        		</ul>
        		<p>An example of Quick Sort is shown below. It starts with the original list; 8, 3, 5, 9, 2, 4, 1, 7, 6</p>
        		
        		<div class="captioned-image">
        			<img alt="Quick sort" src="QuickSortExample.png">
        			<p>The example above shows how a question should be answered when it asks for the Quick Sort algorithm to be used.</p>
        		</div>
        	</div>	
        	
            <div class="notes-others">
        		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/other-notes.php'); ?>
            </div>
    	</div>
		
		<?php include($_SERVER['DOCUMENT_ROOT'] . '/php-assets/footer.php'); ?>
    </body>

</html>