<?php
/**
 * Sentences class
 *
 * @package Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

/**
 * Sentences class.
 *
 * @since 0.1.0
 *
 * @package Canadianize
 * @author  Lisa Schuyler
 *
 */
class Sentences extends Canadianize {

	// Represents one randomly generated sentece
	public $sentence;

	public $canadian_sentences = array();

	public function available_sentences(): array {
		$canadian_sentences = array(
			"I hitched a ride with " . new Person . " with their " . new Adjective . " " . new Vehicle . " to the " . new Store . " up north to pick up some " . new Food . ".",
			"Did you see the size of " . new Person . "'s " . new Noun . "!",
			"After we hit the " . new Store . " we were " . new Verb . " over near " . new Place . ".",
			new Person . " is a real " . new Derogatory . ".",
			"Last time " . new Person . " brought out their " . new Noun . ".",
			new Person . " thought it was " . new Adjective . "! But it was " . new Adjective . " for sure!",
			"I gave my old " . new Noun . " to " . new Person . " and bought a " . new Noun . " from the " . new Store . " for less than a cart of " . new Food . " and some " . new Food . ".",
			"No way!",
			new Person . " wanted to bring " . new Food . " for all the " . new Animal . " in " . new Park . ".",
			"Nah, " . new Person . " was " . new Verb . " wearing nothing but their " . new Clothing . " I heard.",
			ucfirst( (string) new Amount ) . " clicks past the " . new Store . " you'll see " . new Person . " out " . new Verb . " rockin' out to " . new Music . ".",
			new Person . " has a big " . new Animal . " on their " . new Clothing . " alright, a real " . new Derogatory . "!",
			"Remember that time we saw " . new Person . " out for a rip on that " . new Vehicle . " south of " . new Place . "?",
			"Tabarnak!",
			new Store . " has a sweat deal on a " . new Adjective . " " . new Noun . " and " . new Food . " right now eh?",
			"I'll never forget " . new Verb . " with a " . new Vehicle . " full of " . new Food . " in " . new Park . ".",
			"Sorry!",
			"My question is - " . new Food . " from " . new Store . " or " . new Store . "? You tell me.",
			new Person . " told me this joke about " . new Person . " and a " . new Animal . " in " . new Park . " but I didn't believe the part about the " . new Adjective . " " . new Noun . " from " . new Place . "!",
			new Person . " reminded me `" . new Tv . "` is on tonight! Better stock up on " . new Food . ".",
			"Giv'er!",
			"I bet a " . new Noun . " on that " . new Team . " game last night.",
			"Too bad.",
			"Oh man.",
			"Oh!",
			"Almost forgot!",
			"Right?",
			"Sure, fill yer boots!",
			"Too funny!",
			"Fuckin' eh bud!",
			"Ha!",
			"Get out!",
			"Jesus Mary and Joseph!",
			"I passed some " . new Food . " through the fence to the " . new Animal . " on that trip to " . new Place . ".",
			"Did I tell you this already?",
			"This May 2-4 I swore I'd only go " . new Verb . " up by " . new Place . " but " . new Person . " was guest starring on " . new Tv . " and there is no way I was going to go " . new Verb . " without a " . new Noun . ".",
			"Oh for sure!",
			"How are ya bud?",
			ucfirst( (string) new Amount ) . " years ago, I was " . new Verb . " near the " . new Store . " and this " . new Derogatory . " from " . new Place . " and their pet " . new Animal . " stole my " . new Food . " right out of my " . new Vehicle . ".",
			"Take off!",
			ucfirst( (string) new Amount ) . " weeks ago, I popped into the " . new Store . " to pick up a " . new Noun . " for my camp. " . new Person . " had a whole case of " . new Food . " and pushed past me at the checkout, saying, 'Just gonna sneak right past ya`. I said `Sorry` but I did snatch " . new Food . " right out of their cart and ran for my " . new Vehicle . ".",
			"It was a " . new Adjective . " day, and I woke up with the smell of " . new Food . " in the air. I went down to the kitchen and couldn't believe my eyes. There was " . new Person . " " . new Verb . " and snacking on a bowl of " . new Food . ". Weird eh?",
			"It's a little known fact that " . new Animal . " have wandered the plains of " . new Place . " for " . new Amount . " billion years, and all this time they were looking for " . new Food . ". True story! I saw it on " . new Tv . ".",
			"I never go " . new Verb . " before having at least " . new Amount . " " . new Food . " and only while belting out " . new Music . ".",
			"We put our tent up right by " . new Person . "'s over in " . new Park . " and a " . new Animal . " came right of the woods and ate the other guy's " . new Adjective . " " . new Clothing . ".",
			"True story! I saw it on " . new Tv . ".",
			"Last night on " . new Tv . " " . new Person . " was looking under their " . new Vehicle . " for their missing " . new Adjective . " " . new Clothing . ". Little did they know!",
			"I got so lost on my way to " . new Place . ". I survived with nothing but a pocket of " .
			new Food . " and a bit of " . new Animal . " jerky. I just kept " . new Verb . " to stay warm. I knew " . new Person . " was going to swing by in another " . new Amount . " days with their " . new Vehicle . " to get me out of there.",
			"My buddy saw " . new Music . " playing under the stars in " . new Place . ".",
			"Stop me if you've heard this one before. " . ucfirst( (string) new Amount ) . " " . new Animal . " walk into a " . new Store . ".",
			"Deep in the bush outside of " . new Place . " I pet a " . new Animal . " and lived to tell the tale.",
			"Oh! Sorry!",
			new Person . " invented a new cocktail. It's called a " . new Adjective . " " . new Noun . ". It costs " . new Amount . " bucks, and you can only get one at " . new Store . ".",
			"I know, eh?",
			"It reminded me of the time we were " . new Verb . " in " . new Park . " I thought it I saw a ghost! But no, it was " . new Person . " tiptoeing through the bush. I knew I had to follow. What did I see? Well, they went down to the creek and were washing their " . new Clothing . " in the water while humming that " . new Music . " song. Crazy eh?",
			"Jesus Murphy!",
			"Can I borrow your " . new Vehicle . "? I need to make a Timmies run.",
			new Person . " and I went on a real bender that weekend after " . new Music . " opened the " . new Team . " game. In fact, I still can't have " . new Food . " without thinking of it.",
			"After a May 2-4 in " . new Park . " I was feeling real bushed. I knew I had to get out and about but all I wanted to do was park myself in front of a pile of " . new Food . " and watch " . new Tv . " over and over.",
			new Person . " woke me up way too early this morning to go " . new Verb . ". We stopped at " . new Store . " near " . new Place . " for some " . new Food . " for lunch.",
			"I was sitting out in the outhouse when a " . new Animal . " opened the door. Next time I'm bringing my " . new Adjective . " " . new Noun . " and maybe an occupied sign! Besides, there isn't enough TP for both of us.",
			"I ran into a tourist at the " . new Store . ". They asked me if I knew " . new Person . " from over near " . new Place . "! Heck, do I ever! I offered them a lift on my " . new Vehicle . ". Get in and bring your " . new Food . ", I said!",
			"Are you going to " . new Place . " for the fireworks on Canada Day? " . new Person . " is supposed to be the master of ceremonies. I'm going to wear my " . new Adjective . " " . new Clothing . " with a big Canadian flag!",
			"It was a dark and stormy night. I was sitting alone in rec room thinking about " . new Verb . " while watching " . new Tv . " on the tube. " . new Person . " had an infomercial selling a personalized " . new Adjective . " " . new Clothing . "! If you buy " . new Amount . " they'd throw in " . new Amount . " bonus bags of " . new Food . " and free shipping! I bought you " . new Amount . ".",
			"I won free tickets to the " . new Team . " game at the Bingo last night!",
			"Can I bum a dart off ya bud?",
			"I stopped at a garage sale on Saturday, and picked up a " . new Adjective . " " . new Noun . " for just " . new Amount . " bucks!",
			"Ugh, I ate so many " . new Food . " that my " . new Clothing . " and my " .
			new Clothing . " are too tight! I'm going on that new " . new Adjective . " diet. You have to spend " . new Amount . " hours " . new Verb . " and then you are only allowed " . new Food . " and only before six o'clock!",
			"We added a new member to our family! It's a cute little " . new Animal . " that we've named " . new Person . ". It's so " . new Adjective . " and " . new Adjective . "!",
			"Come on yous guys!",
			"I always wanted to be a lumberjack or a fur trader, but instead I spend my time " . new Verb .
			" and working the night shift at " . new Store . ".",
			"I'm planning on spending my summer " . new Verb . " along the Trans Canada Trail. I figure I could get by with just a backpack full of " . new Food . " and maybe some " . new Food . " and my " . new Clothing . ". I heard " . new Person . " did something similar " . new Amount . " years ago, but they were sponsored by " . new Store . " and were mostly just " . new Verb . ".",
			"Did you make it over to " . new Place . " to the " . new Store . "?",
			"I was heading down the " . new Highway . " with my " . new Adjective . " " .
			new Vehicle . ". There was a herd of " . new Animal . " right in the middle of the road! Damn tourist was standing there with a hand full of " . new Food . ".",
			"I won two tickets to the " . new Event . ".",
			"Did I ever tell you about the time I broke down along the " . new Highway . " on my way to the " . new Event . "? " . new Person . " stopped and gave me a boost!",
			"Hearing the loons on the lake in " . new Park . " brought me right back to that time I was out " . new Verb . " and that " . new Animal . " chewed a hole in my " . new Clothing . ".",
			"Would of, but we were watching the " . new Team . " game on that " . new Adjective . " tv my Grandpa won on that scratch off ticket from " . new Store . ".",
			"I forgot my " . new Team . " " . new Clothing . " in " . new Place . " after " . new Verb . ".",
			"That " . new Derogatory . " from " . new Place . " got my " . new Vehicle . " stuck in the snow off the " . new Highway . " while he was trying to pull some " . new Food . " out of his " . new Adjective . " " . new Clothing . "."
		);

		return $canadian_sentences;
	}


	public function __construct() {
		$this->canadian_sentences = $this->available_sentences();
		$this->sentence = $this->create_sentence();
	}

	public function __toString(): string {
		return $this->sentence;
	}

	/**
	 * Generate a random selection from the $canadian_sentences	array and return it.
	 *
	 * @return string Returns a Canadian sentence.
	 * @since 0.1.0
	 *
	 */
	public function create_sentence(): string {
		return $this->canadian_sentences[ array_rand( $this->canadian_sentences ) ];
	}

}
