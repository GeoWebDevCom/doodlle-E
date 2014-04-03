<?xml version="1.0" encoding="UTF-8"?>

<!--
 @version: $Id: review.xsl 3608 2013-07-31 13:20:08Z Radek Suski $
 @package: SobiPro Review & Rating Application

 @author
 Name: Sigrid Suski & Radek Suski, Sigsiu.NET GmbH
 Email: sobi[at]sigsiu.net
 Url: http://www.Sigsiu.NET

 @copyright Copyright (C) 2006 - 2013 Sigsiu.NET GmbH (http://www.sigsiu.net). All rights reserved.
 @license GNU/GPL Version 3
 This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License version 3
 as published by the Free Software Foundation, and under the additional terms according section 7 of GPL v3.
 See http://www.gnu.org/licenses/gpl.html and http://sobipro.sigsiu.net/licenses.

 This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

 $Date: 2013-07-31 15:20:08 +0200 (Mi, 31 Jul 2013) $
 $Revision: 3608 $
 $Author: Radek Suski $
-->

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl">
	<xsl:import href="navigation.xsl" />
	<xsl:output method="xml" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" />

    <!-- The Reviews List Template in details view -->
	<xsl:template name="reviews">
		<xsl:if test="count( //reviews/* )">
            <xsl:call-template name="reviewsReportForm" />
            <div class="clearfix" />
            <div class="review-container">

				<xsl:for-each select="//reviews/review">
					<div class="well well-small container-{position() mod 2}" itemprop="review" itemscope="itemscope" itemtype="http://schema.org/Review">
                        <div class="review-header">
                            <xsl:if test="//reviews/settings/rating_enabled = 1">
                                <div class="rating-stars-{round(@oar)} review-stars" />
                            </xsl:if>
                            <div class="review-title" itemprop="name">
                                <xsl:value-of select="title" disable-output-escaping="yes" /><xsl:text disable-output-escaping="yes">&amp;nbsp;</xsl:text>
                            </div>
                            <xsl:if test="//reviews/settings/rating_enabled = 1">
                                <div class="review-rating" itemprop="reviewRating" itemscope="itemscope" itemtype="http://schema.org/Rating">
                                    <xsl:text>(</xsl:text>
                                    <meta itemprop="worstRating" content="1" />
                                    <span itemprop="ratingValue">
                                        <xsl:value-of select="format-number( @oar, '#0.00')" />
                                    </span>
                                    <xsl:text>/</xsl:text>
                                    <span itemprop="bestRating">10</span>
                                    <xsl:text>)</xsl:text>
                                </div>
                            </xsl:if>
                            <div class="clearfix" />
                            <hr />
							<xsl:value-of select="php:function('SobiPro::Txt', 'SPRRA.REV_AUTHOR_HEAD', php:function('SobiPro::FormatDate', 'j M Y', string(@date)), string(author))" />
                            <meta itemprop="author" content="{string(author)}" />
                            <meta itemprop="datePublished" content="{php:function( 'SobiPro::FormatDate', 'Y-m-d', string(@date) )}" />
						</div>
						<div class="clearfix" />

						<div class="review-body" itemprop="reviewBody">
						    <div class="review-text">
							    <xsl:copy-of select="input/text/node()" />
                            </div>

							<xsl:if test="count(input/positives/*) and //reviews/settings/positive_negative = 1">
								<div class="review-positives">
									<strong>
                                        <xsl:value-of select="author" /><xsl:text> </xsl:text>
										<xsl:value-of select="php:function( 'SobiPro::Txt', 'SPRRA.REV_POSITIVE_POINTS' )" />
										<xsl:text> </xsl:text>
									</strong>
									<xsl:for-each select="input/positives/*">
										<xsl:value-of select="." disable-output-escaping="yes" />
										<xsl:if test="not( position() = last() )">
											<xsl:text>, </xsl:text>
										</xsl:if>
									</xsl:for-each>
								</div>
							</xsl:if>
							<xsl:if test="count(input/negatives/*) and (//reviews/settings/positive_negative = 1)">
								<div class="review-negatives">
									<strong>
                                        <xsl:value-of select="author" /><xsl:text> </xsl:text>
										<xsl:value-of select="php:function( 'SobiPro::Txt', 'SPRRA.REV_NEGATIVE_POINTS' )" />
                                        <xsl:text> </xsl:text>
									</strong>
									<xsl:for-each select="input/negatives/*">
										<xsl:value-of select="." disable-output-escaping="yes" />
										<xsl:if test="not( position() = last() )">
											<xsl:text>, </xsl:text>
										</xsl:if>
									</xsl:for-each>
								</div>
							</xsl:if>
						</div>
						<xsl:if test="count(ratings/*) and (//reviews/settings/rating_enabled = 1)">
							<div class="rating-criteria">
								<xsl:for-each select="ratings/rating">
                                    <div class="row-fluid criteria">
                                        <div class="span4 criteria-label">
                                            <xsl:value-of select="@label" />
                                        </div>
                                        <div class="span8 criteria-stars">
                                            <div class="rating-stars-{round(.)} pulll-left" />
                                            <div class="criteria-value">
                                                <xsl:value-of select="format-number( ., '#' )" />/10
                                            </div>
                                        </div>
                                    </div>
								</xsl:for-each>
							</div>
						</xsl:if>

						<!-- Report Abuse Button -->
                        <xsl:if test="count( //reviews/report_form/* ) or (//reviews/report_form/enabled = 1)">
                            <div class="clearfix">
                                <button class="pull-right btn btn-mini report-review" name="{@id}">
                                    <i class="icon-warning-sign" />
                                    <xsl:text disable-output-escaping="yes">&amp;nbsp;</xsl:text>
                                    <xsl:value-of select="//reviews/report_form/texts/text[@label='report']" />
                                </button>
                            </div>
                        </xsl:if>

                    </div>
				</xsl:for-each>
			</div>
			<xsl:if test="//reviews/navigation/all_sites &gt; 1">
				<button class="btn btn-small hide review-ajax-navigation" data-source="{//entry/@id}">
                    <i class="icon-chevron-down"></i>
                    <xsl:text disable-output-escaping="yes">&amp;nbsp;&amp;nbsp;</xsl:text>
					<xsl:value-of select="php:function( 'SobiPro::Txt', 'SPRRA.LOAD_MORE_AJAX' )" />
                    <xsl:text disable-output-escaping="yes">&amp;nbsp;&amp;nbsp;</xsl:text>
                    <i class="icon-chevron-down"></i>
				</button>
			</xsl:if>
			<div class="review-navigation">
				<xsl:apply-templates select="//reviews/navigation" />
			</div>
		</xsl:if>
	</xsl:template>


    <!-- The Reviews Report Form Template (report abuse) -->
	<xsl:template name="reviewsReportForm">
		<!--
			when "//reviews/report_form/enabled" it means it was an Ajax request and the form is already there
			so we needed this marker just to display the button but not the entire form again
		 -->
		<xsl:if test="count( //reviews/report_form/* ) and not( //reviews/report_form/enabled = 1 )">
			<div class="modal hide fade" id="review-report-form" style="width:630px">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<xsl:text disable-output-escaping="yes">&amp;times;</xsl:text>
					</button>
					<h3>
						<xsl:value-of select="//reviews/report_form/texts/text[@label='window_title']" />
					</h3>
				</div>
				<div class="modal-body">
					<div class="alert alert-error hide" />
					<form class="form-horizontal">
						<div class="control-group">
							<label class="control-label" for="reports-reason">
								<xsl:value-of select="//reviews/report_form/texts/text[@label='select_subject']" />
							</label>
							<div class="controls">
								<select name="reviewReport[reason]" id="reports-reason" class="input-xlarge">
									<xsl:for-each select="//reviews/report_form/subjects/subject">
										<option>
											<xsl:value-of select="." />
										</option>
									</xsl:for-each>
								</select>
							</div>
						</div>
						<xsl:if test="//reviews/report_form/texts/text[@label='enter_name']">
							<div class="control-group">
								<label class="control-label" for="reporter-name">
									<xsl:value-of select="//reviews/report_form/texts/text[@label='enter_name']" />
								</label>
								<div class="controls">
									<div class="input-append">
										<input type="text" id="reporter-name" placeholder="{php:function( 'SobiPro::Txt', 'SPRRA.PH_NAME' )}" name="reviewReport[author]" class="input-xlarge" />
										<span class="add-on">
											<i class="icon-user" />
										</span>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="reporter-email">
									<xsl:value-of select="//reviews/report_form/texts/text[@label='enter_email']" />
								</label>
								<div class="controls">
									<div class="input-append">
										<input type="text" id="reporter-email" placeholder="{php:function( 'SobiPro::Txt', 'SPRRA.PH_EMAIL' )}" name="reviewReport[email]" class="input-xlarge" />
										<span class="add-on">
											<i class="icon-envelope" />
										</span>
									</div>
								</div>
							</div>
						</xsl:if>
						<div class="control-group">
							<label class="control-label" for="review-report-subject">
								<xsl:value-of select="//reviews/report_form/texts/text[@label='enter_subject']" />
							</label>
							<div class="controls">
								<div class="input-append">
									<input type="text" id="review-report-subject" placeholder="{php:function( 'SobiPro::Txt', 'SPRRA.PH_SUBJ' )}" name="reviewReport[subject]" class="input-xlarge" />
									<span class="add-on">
										<i class="icon-edit" />
									</span>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="review-report-text">
								<xsl:value-of select="//reviews/report_form/texts/text[@label='enter_text']" />
							</label>
							<div class="controls">
								<textarea rows="6" cols="15" placeholder="{php:function( 'SobiPro::Txt', 'SPRRA.PH_MSG' )}" name="reviewReport[message]" id="review-report-text" class="input-splarge" />
							</div>
						</div>
						<input type="hidden" name="reviewReport[rid]" id="review-report-rid" value="" />
						<input type="hidden" name="{php:function( 'SobiPro::Token' )}" value="1" />
					</form>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-primary review-report-send-btn">
						<xsl:value-of select="//reviews/report_form/texts/text[@label='send_bt']" />
					</a>
				</div>
			</div>
		</xsl:if>
	</xsl:template>


    <!-- The Review Button and Input Form Template -->
	<xsl:template name="reviewForm">
		<xsl:if test="//review_form/settings/review_enabled = 1">
			<input id="review-trigger-form" type="button" class="btn pull-right" value="{php:function( 'SobiPro::Txt', 'SPRRA.FORM_WRITE_OWN_BT' )}" />
			<div class="modal hide fade" id="review-form" style="width:630px">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<xsl:text disable-output-escaping="yes">&amp;times;</xsl:text>
					</button>
					<h3>
						<xsl:value-of select="php:function( 'SobiPro::Txt', 'SPRRA.FORM_REVIEW_HEAD' )" />
					</h3>
					<div class="alert alert-error hide" />
				</div>
				<div class="modal-body">
					<form class="form-horizontal">
						<xsl:if test="//review_form/settings/review_enabled = 1">
							<div class="control-group">
								<label class="control-label" for="review-title">
									<xsl:value-of select="php:function( 'SobiPro::Txt', 'SPRRA.FORM_REV_TITLE' )" />
								</label>
								<div class="controls">
									<input type="text" id="review-title" placeholder="{php:function( 'SobiPro::Txt', 'SPRRA.PH_TITLE' )}" name="spreview[title]" class="input-xlarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="review-text">
									<xsl:value-of select="php:function( 'SobiPro::Txt', 'SPRRA.FORM_REVIEW' )" />
								</label>
								<div class="controls">
									<textarea rows="10" cols="20" placeholder="{php:function( 'SobiPro::Txt', 'SPRRA.PH_REV' )}" name="spreview[review]" id="review-text" class="input-splarge" />
								</div>
							</div>
						</xsl:if>
						<xsl:if test="//review_form/settings/rating_enabled = 1">
							<div id="review-rating-container">
								<xsl:call-template name="ratingForm" />
							</div>
						</xsl:if>
						<xsl:if test="//review_form/settings/positive_negative = 1">
							<div class="control-group">
								<label class="control-label" for="review-positives">
									<span data-toggle="review-tooltip" title="{php:function( 'SobiPro::Txt', 'SPRRA.REV_POSITIVE_POINTS_EXPL' )}">
										<xsl:value-of select="php:function( 'SobiPro::Txt', 'SPRRA.FORM_POS_REVIEW' )" />
									</span>
								</label>
								<div class="controls">
									<input type="text" id="review-positives" placeholder="{php:function( 'SobiPro::Txt', 'SPRRA.FORM_ADD_POSITIVE' )}" name="spreview[pos_review]" class="input-splarge" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="review-negatives">
									<span data-toggle="review-tooltip" title="{php:function( 'SobiPro::Txt', 'SPRRA.REV_NEGATIVE_POINTS_EXPL' )}">
										<xsl:value-of select="php:function( 'SobiPro::Txt', 'SPRRA.FORM_NEG_REVIEW' )" />
									</span>
								</label>
								<div class="controls">
									<input type="text" id="review-negatives" placeholder="{php:function( 'SobiPro::Txt', 'SPRRA.FORM_ADD_NEGATIVE' )}" name="spreview[neg_review]" class="input-splarge" />
								</div>
							</div>
						</xsl:if>
                        <xsl:if test="//review_form/settings/name_required = 1">
                            <div class="control-group">
                                <label class="control-label" for="review-author">
                                    <xsl:value-of select="php:function( 'SobiPro::Txt', 'SPRRA.FORM_VISITOR_NAME' )" />
                                </label>
                                <div class="controls">
                                    <input type="text" id="review-author" placeholder="{php:function( 'SobiPro::Txt', 'SPRRA.PH_NAME' )}" name="spreview[visitor]" class="input-xlarge" />
                                </div>
                            </div>
                        </xsl:if>
                        <xsl:if test="//review_form/settings/email_required = 1">
                            <div class="control-group">
                                <label class="control-label" for="review-author-mail">
                                    <span data-toggle="review-tooltip" title="{php:function( 'SobiPro::Txt', 'SPRRA.FORM_VISITOR_MAIL_TIP' )}">
                                        <xsl:value-of select="php:function( 'SobiPro::Txt', 'SPRRA.FORM_VISITOR_MAIL' )" />
                                    </span>
                                </label>
                                <div class="controls">
                                    <input type="text" id="review-author-mail" placeholder="{php:function( 'SobiPro::Txt', 'SPRRA.PH_EMAIL' )}" name="spreview[vmail]" class="input-xlarge" />
                                </div>
                            </div>
                        </xsl:if>
						<input type="hidden" name="{//review_form/settings/token}" value="1" />
						<input type="hidden" name="spreview[sid]" value="{//entry/@id}" />
					</form>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-primary" id="review-submit-btn">
						<xsl:value-of select="php:function( 'SobiPro::Txt', 'SPRRA.FORM_SUBMIT_BT' )" />
					</a>
				</div>
			</div>
		</xsl:if>

        <!-- Ratings only Input Form -->
		<xsl:if test="not( //reviews/settings/review_enabled = 1) and //review_form/settings/rating_enabled = 1">
			<input id="review-trigger-form" type="button" class="btn pull-right" value="{php:function( 'SobiPro::Txt', 'SPRRA.FORM_RATE_ENTRY_BT' )}" />
			<div class="modal hide fade" id="review-form" style="width:600px">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<xsl:text disable-output-escaping="yes">&amp;times;</xsl:text>
					</button>
					<h3>
						<xsl:value-of select="php:function( 'SobiPro::Txt', 'SPRRA.FORM_RATE_HEAD' )" />
					</h3>
					<div class="alert alert-error hide" />
				</div>
				<div class="modal-body">
					<form class="form-horizontal">
						<div id="review-rating-container">
							<xsl:call-template name="ratingForm" />
						</div>
						<input type="hidden" name="{//review_form/settings/token}" value="1" />
						<input type="hidden" name="spreview[sid]" value="{//entry/@id}" />
					</form>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-primary" id="review-submit-btn">
						<xsl:value-of select="php:function( 'SobiPro::Txt', 'SPRRA.FORM_SUBMIT_RT_BT' )" />
					</a>
				</div>
			</div>
		</xsl:if>
	</xsl:template>

    <!-- The Rating Form Template -->
	<xsl:template name="ratingForm">
		<xsl:for-each select="//review_form/fields/field">
			<div class="control-group">
				<label class="control-label criteria-control-label" for="criteria-{@id}">
					<span>
						<xsl:if test="explanation">
							<xsl:attribute name="data-toogle">review-tooltip</xsl:attribute>
							<xsl:attribute name="title">
								<xsl:value-of select="explanation" />
							</xsl:attribute>
						</xsl:if>
						<xsl:value-of select="label" />
					</span>
				</label>
				<div class="controls criteria-controls">
					<xsl:variable name="fid" select="@id" />
					<xsl:for-each select="( //* )[ position() &lt;= 10 ]">
						<input type="radio" class="review-rating-star" value="{position()}" name="sprating[{$fid}]">
							<xsl:if test="position() = 1">
								<xsl:attribute name="id">criteria-<xsl:value-of select="$fid" />
								</xsl:attribute>
							</xsl:if>
						</input>
					</xsl:for-each>
				</div>
			</div>
		</xsl:for-each>
	</xsl:template>


    <!-- The Rating Summary Box Template  -->
	<xsl:template name="ratingSummary">
		<xsl:if test="count( reviews/summary_rating )">
			<div class="well well-small rating-summary">
				<div class="rating-summary-count" itemprop="aggregateRating" itemscope="itemscope" itemtype="http://schema.org/AggregateRating">
						<div class="row-fluid summary-criteria">
                            <div class="span4 summary-header"><xsl:value-of select="php:function( 'SobiPro::Txt', 'SPRRA.RATING_SUM')" /></div>
							<div class="span8 summary-criteria-star">
								<div class="rating-stars-{round(reviews/summary_rating/overall)} pulll-left" />
                                <div class="summary-criteria-value">
                                    <xsl:value-of select="reviews/summary_rating/overall" />
                                    <xsl:text> </xsl:text>
                                    <xsl:choose>
                                        <xsl:when test="reviews/summary_rating/overall/@count = 1">
                                            <xsl:value-of select="php:function( 'SobiPro::Txt', 'SPRRA.RATING_SUM_HEAD', number(reviews/summary_rating/overall/@count) )" />
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <xsl:value-of select="php:function( 'SobiPro::Txt', 'SPRRA.RATING_SUMS_HEAD', number(reviews/summary_rating/overall/@count) )" />
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </div>
							</div>
						</div>
					<meta itemprop="worstRating" content="1" />
					<meta itemprop="bestRating" content="10" />
					<meta itemprop="reviewCount" content="{string(reviews/summary_rating/overall/@count)}" />
					<meta itemprop="ratingValue" content="{format-number( reviews/summary_rating/overall, '#0.00')}" />
				</div>

				<div class="rating-summary-criteria">
					<xsl:for-each select="reviews/summary_rating/fields/field">
                        <div class="row-fluid criteria">
                            <div class="span4 criteria-label">
                                <xsl:value-of select="@label" />
                            </div>
                            <div class="span8 criteria-star">
                                <div class="rating-stars-{round(.)} pulll-left" />
                                <div class="criteria-value">
                                    <xsl:value-of select="format-number( ., '#.00' )" />/10
                                </div>
                            </div>
                        </div>
					</xsl:for-each>
				</div>
			</div>
		</xsl:if>
	</xsl:template>

    <!-- The Resulting Rating Stars Template -->
	<xsl:template name="ratingStars">
		<div class="review-rating-stars">
            <div class="rating-stars-{round(reviews/summary_rating/overall)}" />
		</div>
	</xsl:template>
</xsl:stylesheet>
