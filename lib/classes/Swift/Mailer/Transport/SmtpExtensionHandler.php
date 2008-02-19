<?php

/*
 The interface an ESMTP extension handler implement in Swift Mailer.
 
 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program.  If not, see <http://www.gnu.org/licenses/>.
 
 */

//@require 'Swift/Mailer/Transport/SmtpBufferWrapper.php';

/**
 * An ESMTP handler.
 * @package Swift
 * @subpackage Transport
 * @author Chris Corbyn
 */
interface Swift_Mailer_Transport_SmtpExtensionHandler
{
  
  /**
   * Get the name of the ESMTP extension this handles.
   * @return boolean
   */
  public function getHandledKeyword();
  
  /**
   * Set the parameters which the EHLO greeting indicated.
   * @param string[] $parameters
   */
  public function setKeywordParams(array $parameters);
  
  /**
   * Runs immediately after a EHLO has been issued.
   * @param Swift_Mailer_Transport_IoBuffer $buf to read/write
   * @param boolean &$continue needs to be set FALSE if the next extension shouldn't run
   */
  public function afterEhlo(Swift_Mailer_Transport_SmtpBufferWrapper $buf);
  
  /**
   * Get params which are appended to MAIL FROM:<>.
   * @return string[]
   */
  public function getMailParams();
  
  /**
   * Get params which are appended to RCPT TO:<>.
   * @return string[]
   */
  public function getRcptParams();
  
  /**
   * Runs when a command is due to be sent.
   * @param Swift_Mailer_Transport_SmtpBufferWrapper $buf to read/write
   * @param string $command to send
   * @param int[] $codes expected in response
   */
  public function onCommand(Swift_Mailer_Transport_SmtpBufferWrapper $buf,
    $command, $codes = array());
    
  /**
   * Returns +1, -1 or 0 according to the rules for usort().
   * This method is called to ensure extensions can be execute in an appropriate order.
   * @param string $esmtpKeyword to compare with
   * @return int
   */
  public function getPriorityOver($esmtpKeyword);
  
  /**
   * Returns an array of method names which are exposed to the Smtp class.
   * @return string[]
   */
  public function exposeMixinMethods();
  
  /**
   * Tells this handler to clear any buffers and reset its state.
   */
  public function resetState();
  
}