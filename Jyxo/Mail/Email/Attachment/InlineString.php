<?php

/**
 * Jyxo PHP Library
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * https://github.com/jyxo/php/blob/master/license.txt
 */

namespace Jyxo\Mail\Email\Attachment;

/**
 * Inline mail attachment created from a string.
 *
 * @category Jyxo
 * @package Jyxo\Mail
 * @subpackage Email
 * @copyright Copyright (c) 2005-2011 Jyxo, s.r.o.
 * @license https://github.com/jyxo/php/blob/master/license.txt
 * @author Jaroslav Hanslík
 */
class InlineString extends \Jyxo\Mail\Email\Attachment
{
	/**
	 * Type.
	 *
	 * @var string
	 */
	protected $disposition = \Jyxo\Mail\Email\Attachment::DISPOSITION_INLINE;

	/**
	 * Creates an attachment.
	 *
	 * @param string $content File contents
	 * @param string $name Attachment name
	 * @param string $cid Id
	 * @param string $mimeType Attachment mime-type
	 * @param string $encoding Source encoding
	 */
	public function __construct($content, $name, $cid, $mimeType = 'application/octet-stream', $encoding = '')
	{
		$this->setContent($content);
		$this->setName($name);
		$this->setCid($cid);
		$this->setMimeType($mimeType);
		$this->setEncoding($encoding);
	}

	/**
	 * Sets Id.
	 *
	 * @param string $cid
	 * @return \Jyxo\Mail\Email\Attachment\InlineString
	 */
	public function setCid($cid)
	{
		$this->cid = (string) $cid;

		return $this;
	}

	/**
	 * Sets contents encoding.
	 * If none is set, assume no encoding is used.
	 *
	 * @param string $encoding Encoding name
	 * @return \Jyxo\Mail\Email\Attachment\InlineString
	 * @throws \InvalidArgumentException If an incompatible encoding was provided
	 */
	public function setEncoding($encoding)
	{
		if ((!empty($encoding)) && (!\Jyxo\Mail\Encoding::isCompatible($encoding))) {
			throw new \InvalidArgumentException(sprintf('Incompatible encoding %s', $encoding));
		}

		$this->encoding = (string) $encoding;

		return $this;
	}
}
