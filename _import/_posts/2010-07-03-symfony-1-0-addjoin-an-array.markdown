---
layout: post
title: Symfony 1.0 addJoin an array
---

h1. {{ page.title }} 

p(meta). 2010-07-03 14:51:48

In sf1.3, we can use addJoin(array('id_a'm 'id_b'), array('id_1', 'id_2'))
<pre name='code' class='php'>
/**
	 * This is the way that you should add a straight (inner) join of two tables.  For
	 * example:
	 *
	 * <p>
	 * AND PROJECT.PROJECT_ID=FOO.PROJECT_ID
	 * <p>
	 *
	 * left = PROJECT.PROJECT_ID
	 * right = FOO.PROJECT_ID
	 *
	 * @param      mixed $left A String with the left side of the join.
	 * @param      mixed $right A String with the right side of the join.
	 * @param      mixed $operator A String with the join operator e.g. LEFT JOIN, ...
   *
	 * @return     Criteria A modified Criteria object.
	 */
	public function addJoin($left, $right, $operator = null)
	{
		$join = new Join();
    if (!is_array($left)) {
      // simple join
      $join->addCondition($left, $right);
    } else {
      // join with multiple conditions
      // deprecated: use addMultipleJoin() instead
      foreach ($left as $key => $value)
      {
        $join->addCondition($value, $right[$key]);
      }
    }
		$join->setJoinType($operator);
		
		return $this->addJoinObject($join);
	}
</pre>

Sometimes we still work on symfony 1.0. So when we want to join on more keys, it seems impossible.
<pre name='code' class='php'>
select * from books left join categories on book.category_id = categories.id where categories.name='biography'
</pre>
If books has 1,000,000 items. There are 100,000 categories, but only 1000 categories with name 'biography' . The above sql will go through all the categories. But we propel can generated sql like this:
<pre name='code' class='php'>
select * from books left join categories on book.category_id = categories.id and categories.name='biography'
</pre>
This sql can limit the touched categories number to 1000.

So we can do following in symfony 1.0
<pre name='code' class='php'>
$c->addJoin(BookPeer::CATEGORY_ID, CategoryPeer::ID.' AND '.CategoryPeer::NAME.'= "biography"', Criteria::LEFT_JOIN);
</pre>