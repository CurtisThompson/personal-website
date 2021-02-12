function get_external_writing(source = 'None', favourite = 0, limit = 5){
	var writing = extra_writing;
	
	// Filter favourites
	writing = writing.filter(w => w['favourite'] >= favourite);
	
	// Filter source
	if (source !== 'None') {
		writing = writing.filter(w => w['source'] == source);
	}
	
	// Return first x 
	return writing.slice(0, limit)
}

/*
	{'title' : '',
	 'url' : '',
	 'image_src' : '',
	 'description' : '',
	 'source' : '',
	 'favourite' : 0},
*/

extra_writing = [
	{'title' : 'Equifax: A Data Breach for History',
	 'url' : 'https://www.thejrexecutive.com/post/equifax-a-data-breach-in-history',
	 'image_src' : '',
	 'description' : 'In 2017, one of the greatest data breaches of all time was pulled off because of a simple mistake...',
	 'source' : 'JR',
	 'favourite' : 0},
	{'title' : 'The Value of Bitcoin',
	 'url' : 'https://www.thejrexecutive.com/post/the-value-of-bitcoin',
	 'image_src' : '',
	 'description' : 'Bitcoin is the most popular and valued cryptocurrency on the market. But what is it? How does it gain value?',
	 'source' : 'JR',
	 'favourite' : 0},
	{'title' : 'AI and Stock Prices',
	 'url' : 'https://www.thejrexecutive.com/post/ai-and-stock-prices',
	 'image_src' : '',
	 'description' : 'Can artificial intelligence be used to predict stock prices? This article will give you an overview.',
	 'source' : 'JR',
	 'favourite' : 0},
	{'title' : 'The Great Australian-Google Stand-Off',
	 'url' : 'https://www.thejrexecutive.com/post/the-great-australian-google-stand-off',
	 'image_src' : '',
	 'description' : 'As Australia look to implement a new digital law, Google threaten to pull out of the country entirely.',
	 'source' : 'JR',
	 'favourite' : 0},
	{'title' : 'Data Protection Post-Brexit',
	 'url' : 'https://www.thejrexecutive.com/post/data-protection-post-brexit',
	 'image_src' : '',
	 'description' : 'Now that the UK has left the EU, we look at the potential impact on data protection regulations.',
	 'source' : 'JR',
	 'favourite' : 0},
];